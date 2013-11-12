CREATE TABLE Users (
    username        VARCHAR(50)     NOT NULL,
    password        VARCHAR(50)     NOT NULL,
    role            INT             NOT NULL,

    houseNumber     INT             NOT NULL,
    street          VARCHAR(50)     NOT NULL,
    city            VARCHAR(50)     NOT NULL,
    state           CHAR(2)         NOT NULL,
    zip             CHAR(5)         NOT NULL,

    PRIMARY KEY (username)
);

/*
    status:
        0 = pending
        1 = shipped
*/
CREATE TABLE Orders (
    orderId         INT             NOT NULL,
    status          INT             NOT NULL,
    time            TIMESTAMP       NOT NULL,
    total           DECIMAL(10, 2)  NOT NULL,
    username        VARCHAR(50)     NOT NULL,

    PRIMARY KEY (orderId),
    FOREIGN KEY (username) REFERENCES Users(username)
);

/*
    type:
        0 = toy
        1 = game
*/
CREATE TABLE Items (
    isbn            CHAR(10)        NOT NULL,
    quantity        INT             NOT NULL,
    price           DECIMAL(10, 2)  NOT NULL,
    type            INT             NOT NULL,
    name            VARCHAR(50)     NOT NULL,
    promotion       REAL            NOT NULL,

    PRIMARY KEY (isbn)
);

CREATE TABLE OrderItems (
    orderId         INT             NOT NULL,
    isbn            CHAR(10)        NOT NULL,
    quantity        INT             NOT NULL,
    salePrice       DECIMAL(10, 2)  NOT NULL,
    
    PRIMARY KEY (orderId, isbn),
    FOREIGN KEY (orderId) REFERENCES Orders(orderId),
    FOREIGN KEY (isbn) REFERENCES Items(isbn)
);

CREATE TABLE BrowsingHistory (
    username        VARCHAR(50)     NOT NULL,
    isbn            CHAR(10)        NOT NULL,
    views           INT             NOT NULL,

    PRIMARY KEY (username, isbn),
    FOREIGN KEY (username) REFERENCES Users(username),
    FOREIGN KEY (isbn) REFERENCES Items(isbn)
);
