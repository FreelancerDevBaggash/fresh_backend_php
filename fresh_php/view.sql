//62 81
CREATE OR REPLACE VIEW itemsview as
SELECT items.*,categories.* FROM items
INNER JOIN categories ON categories.categories_id = items.items_cat

//---------------------------------------------------------------------
//81
SELECT items1view.*, 1 AS favorite FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid=7
UNION ALL
SELECT * , 0 AS favorite FROM items1view
WHERE items_id != (SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usresid=7)




CREATE VIEW itemsview AS
SELECT items.*,categories.* FROM items
INNER JOIN categories ON categories.categories_id = items.items_cat

/----------------------------------------------------------------------
//87
CREATE OR REPLACE VIEW myfovorite AS
SELECT favorite.*,items.*,userss.users_id FROM favorite
INNER JOIN userss ON userss.users_id = favorite.favorite_usresid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid

//104 + 136 + 137 + 158
CREATE OR REPLACE VIEW cartview AS
SELECT SUM(items.items_price - items.items_price * items_discount / 100) AS itemsprice ,COUNT(cart.cart_itemsid) AS countitems, cart.* , items.* FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_order = 0 
GROUP BY cart.cart_itemsid,cart.cart_usersid,cart.cart_order

//-------------------------------------------------------------------------
//158
CREATE OR REPLACE VIEW ordersview AS
SELECT orders.* , address.* FROM orders 
LEFT JOIN address ON address.address_id=orders.orders_address

//----------------------------------------------------------
//158 + 159
CREATE OR REPLACE VIEW ordersdetailsview AS
SELECT SUM(items.items_price - items.items_price * items_discount / 100) AS itemsprice ,COUNT(cart.cart_itemsid) AS countitems, cart.* , items.*  FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_order != 0 
GROUP BY cart.cart_itemsid,cart.cart_usersid,cart.cart_order



//----------------------------------------------------------
//171 - 173
CREATE OR REPLACE VIEW itemstopselling AS
SELECT COUNT(cart_id) AS countitems, cart.*, items.*, (items_price - (items_price * items_discount / 100)) AS itemspricedisont FROM cart
INNER JOIN items ON items.items_id=cart.cart_itemsid
WHERE cart_order != 0 
GROUP BY cart_itemsid;



CREATE OR REPLACE VIEW ordersdetailsviewlaravel AS 
SELECT cart.cart_order, SUM(items.items_price - items.items_price * items_discount / 100) AS itemsprice ,COUNT(cart.cart_itemsid) AS countitems, items.*  FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_order != 0 
GROUP BY cart.cart_order
