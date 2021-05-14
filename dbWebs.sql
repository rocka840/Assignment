drop database Assignment;

create database Assignment;
use Assignment;

Create table Countries (
    ID_Country int not null AUTO_INCREMENT,
    CountryName varchar(50) UNIQUE,
    PeopleNumber int,
    primary key (ID_Country)
);

Create table People (
    ID_Person int not null AUTO_INCREMENT,
    FirstName varchar(50),
    LastName varchar(50),
    UserName varchar(35) NOT NULL UNIQUE,
    Psw varchar(100) NOT NULL,
    ID_Country int not null,
    UserRole varchar(40),
    primary key (ID_Person),
    foreign key (ID_Country) references Countries(ID_Country)
);

Create table Products (
    ID_Product int not null AUTO_INCREMENT,
    ProductName varchar(50),
    Price varchar(40),
    ItemsAvailable int,
    primary key (ID_Product)
);

Create table Orders (
    ID_Orders int not null AUTO_INCREMENT,
    PersonOrder int,
    primary key (ID_Orders),
    foreign key (PersonOrder) references People(ID_Person)
);

Create table OrderContents (
    ID_OrderContent int not null AUTO_INCREMENT,
    primary key (ID_OrderContent),
    OrderNumber int,
    OrderItem int,
    foreign key (OrderNumber) references Orders(ID_Orders),
    foreign key (OrderItem) references Products(ID_Product)
);

Insert into Countries (CountryName) values ("Luxembourg");
