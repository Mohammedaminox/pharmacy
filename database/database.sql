-- Création de la table User (utilisateurs)
CREATE TABLE User (
    CIN VARCHAR(225) PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL, 
    email VARCHAR(255) ,
    password VARCHAR(255) ,
    type ENUM('Admin', 'PatientEnLigne', 'PatientEnMagasin') NOT NULL
);

-- Création de la table Medicament
CREATE TABLE Medicament (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    quantite_stock INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    IsDeleted  Boolean DEFAULT 0
);

-- Création de la table Vente
CREATE TABLE Vente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicament_id INT,
    user_id  INT,
    type ENUM('VenteEnLigne', 'VenteEnMagasin') NOT NULL,
    date_vente TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (medicament_id) REFERENCES Medicament(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
);


