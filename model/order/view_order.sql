CREATE VIEW view_order AS 
SELECT `order`.*, order_status.order_status_name,order_status.order_status_description , 
staff.role_id, staff.staff_name,staff.mobile AS staff_mobile , staff.username as staff_username, staff.password AS staff_password, staff.email AS staff_email
, customer.customer_name, customer.password AS customer_password, customer.mobile AS customer_mobile, 
customer.email AS customer_email, customer.login_by, customer.housenumber_street AS customer_housenumber_street,
transport.transport_price, tp.province_id AS t_province_id, tp.name AS t_province_name, tp.type AS t_province_type, cw.ward_id AS c_ward_id, cw.name AS c_ward_name,
	cw.type AS c_ward_type, cd.district_id AS c_district_id, cd.name AS c_district_name, cd.type AS c_district_type, cp.province_id AS c_province_id, cp.name AS c_province_name, cp.type AS c_province_type,
	sw.ward_id AS s_ward_id, sw.name AS s_ward_name,
	sw.type AS s_ward_type, sd.district_id AS s_district_id, sd.name AS s_district_name, sd.type AS s_district_type, sp.province_id AS s_province_id, sp.name AS s_province_name, sp.type AS s_province_type
	FROM `order` 
	LEFT JOIN order_status ON order_status.order_status_id=`order`.order_status_id
	LEFT JOIN staff ON staff.staff_id=`order`.staff_id
	LEFT JOIN customer ON customer.customer_id=`order`.customer_id
	LEFT JOIN transport ON transport.transport_id=`order`.transport_id
	LEFT JOIN province tp ON tp.province_id = transport.transport_province_id 
	LEFT JOIN ward cw ON cw.ward_id = customer.ward_id
	LEFT JOIN district cd ON cd.district_id = cw.district_id
	LEFT JOIN province cp ON cp.province_id = cd.province_id
	LEFT JOIN ward sw ON sw.ward_id = `order`.shipping_ward_id
	LEFT JOIN district sd ON sd.district_id = sw.district_id
	LEFT JOIN province sp ON sp.province_id = sd.province_id