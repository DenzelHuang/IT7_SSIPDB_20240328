-- Active: 1709598714114@@127.0.0.1@3306@wms_project
CREATE DATABASE wms_project;

CREATE TABLE products(
    product_id INT AUTO_INCREMENT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    CONSTRAINT pk_product_id PRIMARY KEY (product_id)
);


CREATE TABLE locations(
    location_id INT AUTO_INCREMENT NOT NULL,
    location_name VARCHAR(150) NOT NULL,
    CONSTRAINT pk_location_id PRIMARY KEY (location_id)
);

CREATE TABLE sectors(
    sector_id INT AUTO_INCREMENT NOT NULL,
    location_id INT NOT NULL,
    CONSTRAINT pk_sector_id PRIMARY KEY (sector_id),
    CONSTRAINT fk_sector_location_id FOREIGN KEY (location_id) REFERENCES location(location_id)
);

CREATE TABLE stocks(
    product_id INT NOT NULL,
    product_quantity INT NOT NULL,
    location_id INT NOT NULL,
    sector_id INT NOT NULL,
    CONSTRAINT fk_stock_product_id FOREIGN KEY  (product_id) REFERENCES product(product_id),
    CONSTRAINT fk_stock_location_id FOREIGN KEY (location_id) REFERENCES location(location_id),
    CONSTRAINT fk_stock_sector_id FOREIGN KEY (sector_id) REFERENCES sector(sector_id)
);

CREATE TABLE shipments(
    shipment_id INT AUTO_INCREMENT NOT NULL,
    product_id INT NOT NULL,
    product_quantity INT NOT NULL,
    shipment_date DATE NOT NULL,
    shipment_type CHAR(3) NOT NULL,
    origin_location INT,
    origin_sector INT,
    target_location INT,
    target_sector INT,
    CONSTRAINT pk_shipment_id PRIMARY KEY (shipment_id),
    CONSTRAINT fk_shipment_product_id FOREIGN KEY (product_id) REFERENCES product(product_id),
    CONSTRAINT fk_shipment_origin_location FOREIGN KEY (origin_location) REFERENCES location(location_id),
    CONSTRAINT fk_shipment_origin_sector FOREIGN KEY (origin_sector) REFERENCES sector(sector_id),
    CONSTRAINT fk_shipment_target_location FOREIGN KEY (target_location) REFERENCES location(location_id),
    CONSTRAINT fk_shipment_target_sector FOREIGN KEY (target_sector) REFERENCES sector (sector_id)
);

CREATE TABLE monitorings(
    product_id INT NOT NULL,
    product_quantity INT NOT NULL,
    origin_location INT,
    origin_sector INT,
    target_location INT NOT NULL,
    target_sector INT NOT NULL,
    date DATE NOT NULL,
    CONSTRAINT fk_monitoring_product_id FOREIGN KEY (product_id) REFERENCES product(product_id),
    CONSTRAINT fk_monitoring_origin_location FOREIGN KEY (origin_location) REFERENCES location(location_id),
    CONSTRAINT fk_monitoring_origin_sector FOREIGN KEY (origin_sector) REFERENCES sector(sector_id),
    CONSTRAINT fk_monitoring_target_location FOREIGN KEY (target_location) REFERENCES location(location_id),
    CONSTRAINT fk_monitoring_target_sector FOREIGN KEY (target_sector) REFERENCES sector(sector_id)
);

CREATE TABLE accounts(
    user_id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    CONSTRAINT pk_user_id PRIMARY KEY (user_id)
);

INSERT INTO products (product_name) VALUES ('Assorted Metal Shavings - 1 kg bag');
INSERT INTO products (product_name) VALUES ('Plywood Sheet - 100x100x1 cm');
INSERT INTO products (product_name) VALUES ('Hydrogen Peroxide - 1 L bottle');
INSERT INTO products (product_name) VALUES ('Steel Filings - 500g bag');
INSERT INTO products (product_name) VALUES ('Hardwood Plank - 50x50x1 cm');
INSERT INTO products (product_name) VALUES ('Industrial Cleaning Solution - 2 L bottle');
INSERT INTO products (product_name) VALUES ('Mixed Metal Alloys - 750g bag');
INSERT INTO products (product_name) VALUES ('Lumber Block - 25x25x1 cm ');
INSERT INTO products (product_name) VALUES ('Acidic Solution - 500 ml bottle');
INSERT INTO products (product_name) VALUES ('Brass Shavings - 250g bag');
INSERT INTO products (product_name) VALUES ('Laminated Particle Board - 75x75x1 cm');
INSERT INTO products (product_name) VALUES ('Solvent Solution - 1 L bottle');
INSERT INTO products (product_name) VALUES ('Copper Shavings - 500g bag');
INSERT INTO products (product_name) VALUES ('Panel Board - 120x60x1 cm');
INSERT INTO products (product_name) VALUES ('Oxidizing Agent - 750 ml bottle');

INSERT INTO locations (location_name) VALUES ('Jakarta');
INSERT INTO locations (location_name) VALUES ('Surabaya');
INSERT INTO locations (location_name) VALUES ('Bandung');

INSERT INTO sectors (location_id) VALUES (1);
INSERT INTO sectors (location_id) VALUES (1);
INSERT INTO sectors (location_id) VALUES (1);
INSERT INTO sectors (location_id) VALUES (2);
INSERT INTO sectors (location_id) VALUES (2);
INSERT INTO sectors (location_id) VALUES (2);
INSERT INTO sectors (location_id) VALUES (3);
INSERT INTO sectors (location_id) VALUES (3);
INSERT INTO sectors (location_id) VALUES (3);

INSERT INTO accounts (username, password) VALUES ('denzel', 'admin');
INSERT INTO accounts (username, password) VALUES ('diego', 'admin');
INSERT INTO accounts (username, password) VALUES ('sarah', 'admin');

INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '1', '1');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '1', '2');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '1', '3');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '2', '4');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '2', '5');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '2', '6');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '3', '7');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '3', '8');
INSERT INTO shipments (shipment_date, shipment_type, target_location, target_sector) VALUES ('2024-01-01', 'IN', '3', '9');

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (1, 1, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (1, 2, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (2, 3, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (2, 4, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (3, 5, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (4, 6, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (4, 7, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (5, 8, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (5, 9, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (6, 10, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (7, 11, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (7, 12, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (8, 13, 10);
INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (8, 14, 10);

INSERT INTO shipped_products (shipment_id, product_id, product_quantity) VALUES (9, 15, 10);

INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (1, 10, 1, 1);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (2, 10, 1, 1);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (3, 10, 1, 2);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (4, 10, 1, 2);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (5, 10, 1, 3);

INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (6, 10, 2, 4);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (7, 10, 2, 4);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (8, 10, 2, 5);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (9, 10, 2, 5);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (10, 10, 2, 6);

INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (11, 10, 3, 7);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (12, 10, 3, 7);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (13, 10, 3, 8);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (14, 10, 3, 8);
INSERT INTO stocks (product_id, product_quantity, location_id, sector_id) VALUES (15, 10, 3, 9);