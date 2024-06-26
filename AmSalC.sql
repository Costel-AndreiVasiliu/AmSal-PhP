drop database amsalc;

CREATE DATABASE amsalc;

USE amsalc;

CREATE TABLE tip_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    denumire VARCHAR(50) NOT NULL
);

INSERT INTO tip_user (denumire) VALUES ('admin'), ('contabil');

CREATE TABLE useri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tip_user_id INT,
    FOREIGN KEY (tip_user_id) REFERENCES tip_user(id)
);


CREATE TABLE pagini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume_meniu VARCHAR(255) NOT NULL,
    pagina VARCHAR(255) NOT NULL,
    meniu INT(1) NOT NULL
);


INSERT INTO pagini (nume_meniu, pagina, meniu) VALUES 
('Dashboard', 'admin_dashboard.php', 1),
('Angajati', 'admin_angajati.php', 1),
('Contabili', 'admin_contabili.php', 1),
('Functii', 'admin_functii.php', 1),
('Firme', 'admin_firme.php', 1),
('Account Settings', 'admin_account_settings.php', 1),
('Logout', 'logout.php', 1),
('Dashboard', 'contabil_dashboard.php', 1),
('Pontaj', 'contabil_pontaj.php', 1),
('jutor contabili', 'contabil_ajutor_contabili.php', 1),
('Account Settings', 'contabil_account_settings.php', 1),
('Logout', 'logout.php', 1),
('Admin - Adaugare Angajat', 'admin_adaugare_angajat.php', 0),
('Admin - Adaugare Contabil', 'admin_adaugare_contabil.php', 0),
('Admin - Adaugare Firma', 'admin_adaugare_firma.php', 0),
('Admin - Adaugare Functie', 'admin_adaugare_functie.php', 0),
('Admin - Vizualizare Angajati Lista', 'admin_vizualizare_angajati_lista.php', 0),
('Admin - Vizualizare Contabili Lista', 'admin_vizualizare_contabili_lista.php', 0),
('Admin - Vizualizare Firme Lista', 'admin_vizualizare_firme_lista.php', 0),
('Admin - Vizualizare Functii Lista', 'admin_vizualizare_functii_lista.php', 0),
('Contabil - Editare Ajutor', 'contabil_editare_ajutor.php', 0),
('Contabil - Editare Pontaj', 'contabil_editare_pontaj.php', 0),
('Contabil - Adauga Luna Pontaj', 'contabil_pontaj_adauga_luna.php', 0),
('Contabil - Vizualizare Lista Ajutoare', 'contabil_vizualizare_lista_ajutoare.php', 0),
('Contabil - Vizualizare Pontaj', 'contabil_vizualizare_pontaj.php', 0),
('Editare Angajat', 'editare_angajat.php', 0),
('Editare Contabil', 'editare_contabil.php', 0),
('Editare Firma', 'editare_firma.php', 0),
('Editare Functie', 'editare_functie.php', 0),
('Footer', 'footer.php', 0),
('Header Admin', 'header_admin.php', 0),
('Header Contabil', 'header_contabil.php', 0),
('Index', 'index.php', 0),
('Login', 'login.php', 0),
('Procesare Account Settings Company', 'procesare_account_settings_company.php', 0),
('Procesare Account Settings Contabil', 'procesare_account_settings_contabil.php', 0),
('Procesare Account Settings User', 'procesare_account_settings_user.php', 0),
('Procesare Adaugare Angajat', 'procesare_adaugare_angajat.php', 0),
('Procesare Adaugare Contabil', 'procesare_adaugare_contabil.php', 0),
('Procesare Adaugare Firma', 'procesare_adaugare_firma.php', 0),
('Procesare Adaugare Functie', 'procesare_adaugare_functie.php', 0),
('Procesare Adaugare Pontaj', 'procesare_adaugare_pontaj.php', 0),
('Procesare Ajutor Contabili', 'procesare_ajutor_contabili.php', 0),
('Procesare Editare Ajutor', 'procesare_editare_ajutor.php', 0),
('Procesare Editare Angajat', 'procesare_editare_angajat.php', 0),
('Procesare Editare Contabil', 'procesare_editare_contabil.php', 0),
('Procesare Editare Firma', 'procesare_editare_firma.php', 0),
('Procesare Editare Functie', 'procesare_editare_functie.php', 0),
('Redirect', 'redirect.php', 0),
('Register Process', 'register_process.php', 0),
('Register', 'register.php', 0),
('Stergere Angajat', 'stergere_angajat.php', 0),
('Stergere Contabil', 'stergere_contabil.php', 0),
('Stergere Firma', 'stergere_firma.php', 0),
('Stergere Functie', 'stergere_functie.php', 0),
('Contabil-Stergere pontaj', 'contabil_stergere_pontaj.php', 0),
('Contabil-Stergere ajutor', 'contabil_stergere_ajutor.php', 0);


INSERT INTO useri (name, email, password, tip_user_id) VALUES
('Admin', 'admin@yahoo.com', '$2y$10$e0NRD6pA7G5a7OtbAkNN3OHHEtFGpA58yD0mGadVvMK7An6RA9vEi', 1),
('Contabil', 'contabil@yahoo.com', '$2y$10$e0NRD6pA7G5a7OtbAkNN3OHHEtFGpA58yD0mGadVvMK7An6RA9vEi', 2);


CREATE TABLE drepturi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    IdPage INT NOT NULL,
    IdUser INT NOT NULL,
    FOREIGN KEY (IdPage) REFERENCES pagini(id),
    FOREIGN KEY (IdUser) REFERENCES useri(id)
);

INSERT INTO drepturi (IdPage, IdUser) SELECT id, 1 FROM pagini;

INSERT INTO drepturi (IdPage, IdUser) VALUES 
(8, 2), (9, 2), (10, 2), (11, 2), (12, 2), (21, 2), (22, 2), (23, 2), (24, 2), (25, 2), (27, 2), (30, 2), (32, 2), (33, 2), (34, 2), (36, 2), (39, 2),
(42, 2), (43, 2), (44, 2), (46, 2), (49, 2), (50, 2), (51, 2), (53,2), (56, 2), (57, 2); 


CREATE TABLE angajati (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(50) NOT NULL,
    prenume VARCHAR(50) NOT NULL,
    numar_telefon VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    functie VARCHAR(50) NOT NULL,
    salariu DECIMAL(10, 2) NOT NULL,
    buletin VARCHAR(255) NOT NULL,
    data_angajare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


alter table angajati add column `cnp` varchar(13);

CREATE TABLE contabili (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(50) NOT NULL,
    prenume VARCHAR(50) NOT NULL,
    numar_telefon VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    functie VARCHAR(50) NOT NULL,
    salariu DECIMAL(10, 2) NOT NULL,
    buletin VARCHAR(255) NOT NULL,
    data_angajare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE functii (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume_functie VARCHAR(100) NOT NULL,
    salariu DECIMAL(10, 2) NOT NULL,
    perioada_contractuala VARCHAR(50) NOT NULL,
    numar_angajati INT NOT NULL,
    data_adaugare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE firme (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    cif VARCHAR(20) NOT NULL,
    reg_com VARCHAR(50) NOT NULL,
    forma_juridica VARCHAR(50) NOT NULL,
    banca VARCHAR(100) NOT NULL,
    iban VARCHAR(34) NOT NULL,
    adresa VARCHAR(255) NOT NULL,
    localitate VARCHAR(100) NOT NULL,
    judet VARCHAR(100) NOT NULL,
    tara VARCHAR(100) NOT NULL,
    capital_social DECIMAL(10, 2) NOT NULL,
    platitor_tva VARCHAR(10) NOT NULL,
    data_adaugare TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE pontaj (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume_luna VARCHAR(255) NOT NULL,
    total_ore_lucratoare INT NOT NULL
);

CREATE TABLE ajutor_contabili (
    id INT AUTO_INCREMENT PRIMARY KEY,
    angajat_id INT NOT NULL,
    tip_job VARCHAR(255) NOT NULL,
    FOREIGN KEY (angajat_id) REFERENCES angajati(id) ON DELETE CASCADE
);
