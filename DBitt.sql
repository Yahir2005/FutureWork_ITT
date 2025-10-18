-- Usamos InnoDB como motor para soportar transacciones y claves foráneas.
-- Usamos utf8mb4 para una compatibilidad completa con emojis y caracteres especiales.


CREATE TABLE Rol(   
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombreRol VARCHAR(50)
);
INSERT INTO Rol(nombreRol) VALUES ("Empresa"),("Postulante"),("Administrador");
CREATE TABLE Carrera(
    idCarrera INT AUTO_INCREMENT PRIMARY KEY,
    nombreCarrera VARCHAR(100)
);

CREATE TABLE Usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    idRol INT,
    nombreCompleto VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contraseñaHash VARCHAR(255) NOT NULL,
    fechaRegistro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idRol) REFERENCES Rol(idRol) 
); 


-- --------------------------------------------------------
-- TABLA 2: EGRESADOS
-- Almacena la información del perfil de un usuario con rol 'Egresado'.
-- --------------------------------------------------------

CREATE TABLE InformacionPostulante (
    idUsuario INT PRIMARY KEY,
    idCarrera INT,
    idRol INT,
    numeroControl VARCHAR(20) ,
    cvPath VARCHAR(255) /*COMMENT 'Ruta al archivo PDF del CV'*/,
    telefono VARCHAR(20),
    ubicacion VARCHAR(255),
    FOREIGN KEY (idRol) REFERENCES Rol(idRol),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario),
    FOREIGN KEY (idCarrera) REFERENCES Carrera(idCarrera)
);

-- --------------------------------------------------------
-- TABLA 3: EMPRESAS
-- Almacena la información del perfil de un usuario con rol 'Empresa'.
-- --------------------------------------------------------

CREATE TABLE estadoValidacionEmpresa(
    idEstadoValidacionEmpresa INT AUTO_INCREMENT PRIMARY KEY,
    estadoValidacionEmpresa VARCHAR(15) NOT NULL
); 

INSERT INTO estadoValidacionEmpresa(estadoValidacionEmpresa) VALUES ("Pendiente"),("Validado"),("Rechazado");

CREATE TABLE Empresas (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    idEstadoValidacionEmpresa INT,
    idRol INT,
    nombreEmpresa VARCHAR(255) NOT NULL,
    sector VARCHAR(100),
    representante VARCHAR(255),
    descripcion TEXT,
    sitioWeb VARCHAR(255),
    FOREIGN KEY (idRol) REFERENCES Rol(idRol),
    FOREIGN KEY (idEstadoValidacionEmpresa) REFERENCES estadoValidacionEmpresa(idEstadoValidacionEmpresa),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE
);


-- --------------------------------------------------------
-- TABLA 4: HABILIDADES (Catálogo)
-- Tabla de catálogo para evitar la repetición de nombres de habilidades.
-- --------------------------------------------------------

CREATE TABLE Habilidades (
    idHabilidad INT AUTO_INCREMENT PRIMARY KEY,
    nombreHabilidad VARCHAR(100) NOT NULL UNIQUE
);

-- --------------------------------------------------------
-- TABLA 5: POSTULANTE_HABILIDADES (Tabla Pivote)
-- Relaciona a los POSTULADO con sus habilidades (relación muchos a muchos).
-- --------------------------------------------------------

CREATE TABLE Postulante_Habilidades (
    idUsuario INT NOT NULL,
    idHabilidad INT NOT NULL,
    PRIMARY KEY (idUsuario, idHabilidad),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE,
    FOREIGN KEY (idHabilidad) REFERENCES Habilidades(idHabilidad) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- TABLA 6: EXPERIENCIA_LABORAL
-- Almacena los diferentes puestos de trabajo de un egresado.
-- --------------------------------------------------------

CREATE TABLE Experiencia_Laboral (
    idExperiencia INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    puesto VARCHAR(150) NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    descripcion TEXT,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- TABLA 7: CERTIFICACIONES
-- Almacena las certificaciones de un egresado.
-- --------------------------------------------------------

CREATE TABLE Certificaciones (
    idCertificacion INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    organizacionEmisora VARCHAR(255) NOT NULL,
    fechaObtencion DATE,
    urlCredencial VARCHAR(255),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- TABLA 8: VACANTES
-- Almacena la información de las ofertas de trabajo publicadas por las empresas.
-- --------------------------------------------------------

CREATE Table estadoValidacionVacante(
    idEstadoValidacionVacante int AUTO_INCREMENT PRIMARY KEY,
    estadoValidacion VARCHAR(20) NOT NULL
);
INSERT INTO estadoValidacionVacante(estadoValidacion) VALUES ("Abierta"),("Cerrada"),("Pausada");

CREATE TABLE tipoContrato(
    idTipoContrato INT AUTO_INCREMENT PRIMARY KEY,
    estadoContrato  VARCHAR(20) NOT NULL
);

INSERT INTO tipoContrato(estadoContrato) VALUES ("Tiempo Completo"),("Medio Tiempo"),("Por Proyecto"),("Pasantía");

CREATE TABLE Vacantes (
    idVacante INT AUTO_INCREMENT PRIMARY KEY,
    idEmpresa INT NOT NULL COMMENT 'FK a la tabla Empresas (que usa idUsuario)',
    idEstadoValidacionVacante INT,
    idTipoContrato INT,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    requisitos TEXT,
    ubicacion VARCHAR(255) NOT NULL,
    salario DECIMAL(10, 2),
    fechaPublicacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaLimite DATE,
    FOREIGN KEY (idTipoContrato) REFERENCES tipoContrato(idTipoContrato),
    FOREIGN KEY (idEstadoValidacionVacante) REFERENCES estadoValidacionVacante(idEstadoValidacionVacante),
    FOREIGN KEY (idEmpresa) REFERENCES Empresas(idUsuario) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- TABLA 9: POSTULACIONES
-- Tabla que registra la aplicación de un egresado a una vacante.
-- --------------------------------------------------------
CREATE TABLE estadoPostulacion(
    idEstadoPostulacion INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(20) NOT NULL
);
INSERT INTO estadoPostulacion(estado) VALUES ("Enviada"),("En Revision"),("Aceptada"),("Rechazada");

CREATE TABLE Postulaciones (
    idPostulacion INT AUTO_INCREMENT PRIMARY KEY,
    idVacante INT NOT NULL,
    idEgresado INT NOT NULL,
    idEstadoPostulacion INT,
    fechaPostulacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idEstadoPostulacion) REFERENCES estadoPostulacion(idEstadoPostulacion),
    FOREIGN KEY (idVacante) REFERENCES Vacantes(idVacante) ON DELETE CASCADE,
    FOREIGN KEY (idEgresado) REFERENCES Egresados(idUsuario) ON DELETE CASCADE,
    UNIQUE (idVacante, idEgresado) COMMENT 'Evita que un egresado postule dos veces a la misma vacante'
); 

-- --------------------------------------------------------
-- TABLA 10: NOTIFICACIONES
-- Almacena notificaciones para los usuarios.
-- --------------------------------------------------------

CREATE TABLE Notificaciones (
    idNotificacion INT AUTO_INCREMENT PRIMARY KEY,
    idUsuarioDestino INT NOT NULL,
    mensaje TEXT NOT NULL,
    tipo VARCHAR(50) COMMENT 'Ej: NuevaPostulacion, CambioEstado, MensajeAdmin',
    fechaEnvio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (idUsuarioDestino) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE
);


