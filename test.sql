use Assignment;

SELECT ID_Orders, UserName, OrderStatus.OrderStatus
from Orders, People, OrderStatus 
where Orders.PersonOrder=People.ID_Person and Orders.OrderStatus=OrderStatus.ID_Status;