CREATE VIEW view_product AS 
SELECT product.*,
	ROUND(
		IF(
			discount_percentage IS NULL || 
			discount_from_date > CURRENT_DATE || 
			discount_to_date < CURRENT_DATE , 

			price, 
			price * (1-discount_percentage/100)
		), -3) AS sale_price 
FROM product;

-- 45,000đ => giảm 5%, còn 45,000 * 0.95 = 42,750. Cần bán với giá 43,000đ (yes?)


-- round(4.7256, 3) => 4.726
-- round(42750, -3) => 43000