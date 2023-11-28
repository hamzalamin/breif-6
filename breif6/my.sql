CREATE DATABASE electronBreif6;

CREATE TABLE categories ( categorie_id INT PRIMARY KEY, categorie_name VARCHAR(300), categorie_description VARCHAR(900), categorie_pic VARCHAR(300) );


CREATE TABLE products (
    reference varchar(500),
    image varchar(200),
    etiquette CHAR(200),
    code_barres int,
    prix_dachat int,
    prix_final int,
    Offre_de_prix int,
    description varchar(900),
    quantite_min int,
    quantite_stock int,
    categorie_id_fk int,
    FOREIGN KEY (categorie_id_fk) REFERENCES categories(categorie_id)    
);

CREATE TABLE users(
    user_name varchar(200),
    email varchar(200),
    pass varchar(200),
    isadmin boolean DEFAULT false
);

INSERT INTO `users`(`user_name`, `email`, `pass`, `isadmin`) VALUES ('admin','hamza@gmail.com','14hamza', TRUE);