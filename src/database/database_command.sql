-- create and delete the database
CREATE DATABASE database_name
CREATE DATABASE if not exists database_name

DROP DATABASE database_name

-- entry database_name
use database_name;

-- create and delete the table
CREATE TABLE table_name
CREATE TABLE if not exists table_name(
	col1 varchar(max),
	col2 int(max) AUTO_INCREMENT NOT NULL,
	col3 date(yyyymmdd)
)

DROP TABLE table_name

-- insert and delete the data
INSERT INTO table_name VALUE (value1, value2...)

INSERT INTO table_name (col1, col2...) VALUE (value1, value2...)

DELETE FROM table_name WHERE col_name = value

	-- delete all row in the table 
DELETE FROM table_name
DELETE * FORM table_name

-- -- sentence JOIN
-- JOIN and INNER JOIN: 如果表中有至少一个匹配，则返回行
-- LEFT JOIN: 即使右表中没有匹配，也从左表返回所有的行
-- RIGHT JOIN: 即使左表中没有匹配，也从右表返回所有的行
-- FULL JOIN: 只要其中一个表中存在匹配，就返回行

SELECT table_name1.col1, table_name1.col2, table_name2.col1
FROM table_name1
INNER JOIN table_name2
ON table_name1.Id_P = table_name2.Id_P
ORDER BY table_name1.col1