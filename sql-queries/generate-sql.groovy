random = new Random()

// Modified version of code here:
// http://www.codecodex.com/wiki/Generate_a_random_password_or_random_string#Groovy
def randomStringFromPool(pool) {
    pool = pool.flatten()
    (0..<2).collect {
        def idx = random.nextInt(pool.size)
        pool[idx]
    }.join()
}

def randomState = {
    randomStringFromPool(['A'..'Z'])
}

def generateUserQueries = { String baseName, int role, int count ->
    def query = 'INSERT INTO Users\nVALUES\n'
    
    (0..<count).collect { id ->

       def username = "${baseName}${id}"
       def password = "${id}${baseName[0]}"

       def houseNumber = random.nextInt(1000)
       def state = randomState()

       def zip = 10000 + random.nextInt() * 9000
       zip = (zip < 0) ? zip * -1 : zip

       query += "('${username}', '${password}', ${role}, ${houseNumber}, 'Street ${id}', 'City ${id}', '${state}', '${zip}'),\n"
    }

    // Insert semicolon before last line break
    query[0..-3] + ';\n'
}

def randomIsbn = {
    randomStringFromPool(['0'..'9'])
}

def generateItemQueries = { int count -> 
    def query = 'INSERT INTO Items\nVALUES\n'

    def usedIsbns = []

    (0..<count).collect { id ->
        def isbn = randomIsbn() 

        // isbn must be unique 
        while(usedIsbns.find { it == isbn } != null) { 
            isbn = randomIsbn() 
        }

        usedIsbns << isbn

        def quantity = random.nextInt(100)

        def price = "${random.nextInt(50)}.${random.nextInt(100)}"
        def type = (id + random.nextInt(1234)) % 2

        def name = (type == 0) ? "toy_" : "game_"
        name += "${id}"

        query += "('${isbn}', ${quantity}, ${price}, ${type}, '${name}', 1.0),\n"
    }

    query[0..-3] + ';\n'
}

customerCount = 10
staffCount = 4
adminCount = 2

itemsCount = 20

new File('populate-tables.sql').withPrintWriter { writer ->
    writer.println generateUserQueries('customer_', 0, customerCount)
    writer.println generateUserQueries('staff_', 1, staffCount)
    writer.println generateUserQueries('admin_',2, adminCount)
    writer.println generateItemQueries(itemsCount)
}
