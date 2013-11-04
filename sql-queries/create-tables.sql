CREATE TABLE Users (
    username        VARCHAR(50)     NOT NULL,
    password        VARCHAR(50),
    role            INT,

    houseNumber     INT,
    street          VARCHAR(50),
    city            VARCHAR(50),
    state           CHAR(2),
    zip             CHAR(5),

    PRIMARY KEY (username)
);

/*
    status:
        0 = pending
        1 = shipped
*/
CREATE TABLE Orders (
    orderId         INT         NOT NULL,
    status          INT,
    time            TIMESTAMP,
    total           DECIMAL(10, 2),
    username        VARCHAR(50) NOT NULL,

    PRIMARY KEY (orderId),
    FOREIGN KEY (username) REFERENCES Users(username)
);

/*
    type:
        0 = toy
        1 = game
*/
CREATE TABLE Items (
    isbn            CHAR(10)    NOT NULL,
    quantity        INT,
    price           DECIMAL(10, 2),
    type            INT,
    name            VARCHAR(50),
    promotion       REAL,

    PRIMARY KEY (isbn)
);

CREATE TABLE OrderItems (
    orderId         INT         NOT NULL,
    isbn            CHAR(10)    NOT NULL,
    quantity        INT,
    salePrice       DECIMAL(10, 2),
    
    PRIMARY KEY (orderId, isbn),
    FOREIGN KEY (orderId) REFERENCES Orders(orderId),
    FOREIGN KEY (isbn) REFERENCES Items(isbn)
);

CREATE TABLE BrowsingHistory (
    username        VARCHAR(50)     NOT NULL,
    isbn            CHAR(10)        NOT NULL,
    views           INT,

    PRIMARY KEY (username, isbn),
    FOREIGN KEY (username) REFERENCES Users(username),
    FOREIGN KEY (isbn) REFERENCES Items(isbn)
);