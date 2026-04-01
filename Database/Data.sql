CREATE DATABASE Futurework_ITT;
USE Futurework_ITT;

-- TABLA : Sub-Usuarios
CREATE TABLE Rol(
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombreRol VARCHAR(45) NOT NULL
);

INSERT INTO Rol(nombreRol) VALUES ("Empresa"),("Postulante"),("Administrador");

-- TABLA : Usuarios
CREATE TABLE Usuarios(
    idUsuarios INT AUTO_INCREMENT PRIMARY KEY,
    Rol_idRol INT NOT NULL,
    nombreCompleto VARCHAR(45),
    email VARCHAR(45),
    Password VARCHAR(50),
    fechaRegistro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Rol_idRol) REFERENCES Rol(idRol)
);

-- TABLA : Carreras y Postulantes
CREATE TABLE Carrera(
    idCarrera INT AUTO_INCREMENT PRIMARY KEY,
    nombreCarrera VARCHAR(100)
);

CREATE TABLE Postulante(
    idPostulante INT AUTO_INCREMENT PRIMARY KEY,
    Carrera_idCarrera INT NOT NULL,
    Usuarios_idUsuarios INT NOT NULL,
    numeroControl VARCHAR(10),
    cvPath VARCHAR(255),
    telefono VARCHAR(45),
    ubicacion VARCHAR(45),
    FOREIGN KEY (Usuarios_idUsuarios) REFERENCES Usuarios(idUsuarios),
    FOREIGN KEY (Carrera_idCarrera) REFERENCES Carrera(idCarrera)
);

-- TABLA : EstadoValidacionEmpresa y Empresas
CREATE TABLE EstadoValidacionEmpresa(
    idEstadoValidacionEmpresa INT AUTO_INCREMENT PRIMARY KEY,
    estadoValidacionEmpresa VARCHAR(45)
);

INSERT INTO EstadoValidacionEmpresa(estadoValidacionEmpresa) VALUES ("Pendiente"),("Validado"),("Rechazado");

CREATE TABLE Empresas(
    idEmpresas INT AUTO_INCREMENT PRIMARY KEY,
    Usuarios_idUsuarios INT NOT NULL,
    EstadoValidacionEmpresa_idEstadoValidacionEmpresa INT NOT NULL,
    nombreEmpresa VARCHAR(45),
    sector VARCHAR(45),
    representante VARCHAR(45),
    descripcion TEXT,
    sitioWeb VARCHAR(45),
    FOREIGN KEY (EstadoValidacionEmpresa_idEstadoValidacionEmpresa) REFERENCES EstadoValidacionEmpresa(idEstadoValidacionEmpresa),
    FOREIGN KEY (Usuarios_idUsuarios) REFERENCES Usuarios(idUsuarios)
);

-- TABLA : Imagenes de Empresa
CREATE TABLE EmpresaImagenPerfil(
    idEmpresaPerfilImagen INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    rutaImagenPerfilEmpresa VARCHAR(255)
);

CREATE TABLE ImagenPerfilEmpresa(
    idImagenEmpresa INT AUTO_INCREMENT PRIMARY KEY,
    Empresas_idEmpresas INT NOT NULL,
    EmpresaPerfilImagen_idEmpresaPerfilImagen INT NOT NULL,
    FOREIGN KEY (Empresas_idEmpresas) REFERENCES Empresas(idEmpresas),
    FOREIGN KEY (EmpresaPerfilImagen_idEmpresaPerfilImagen) REFERENCES EmpresaImagenPerfil(idEmpresaPerfilImagen)
);

CREATE TABLE ImagenesEmpresa(
    idImagenEmpresa INT AUTO_INCREMENT PRIMARY KEY,
    Empresas_idEmpresas INT NOT NULL,
    rutaImagenEmpresa VARCHAR(255) NOT NULL,
    urlImagen VARCHAR(255),
    FOREIGN KEY (Empresas_idEmpresas) REFERENCES Empresas(idEmpresas)
);

-- TABLA : Imagenes de Postulante
CREATE TABLE PostulanteImagenPerfil(
    idImagenPerfilPostulante INT AUTO_INCREMENT PRIMARY KEY,
    nombreImagen VARCHAR(255) NOT NULL,
    rutaImagenPerfilPostulante VARCHAR(255)
);

CREATE TABLE ImagenesPerfilPostulante(
    idImagenPostulante INT AUTO_INCREMENT PRIMARY KEY,
    Postulante_idPostulante INT NOT NULL,
    PostulanteImagenPerfil_idImagenPerfilPostulante INT NOT NULL,
    FOREIGN KEY (Postulante_idPostulante) REFERENCES Postulante(idPostulante),
    FOREIGN KEY (PostulanteImagenPerfil_idImagenPerfilPostulante) REFERENCES PostulanteImagenPerfil(idImagenPerfilPostulante)
);

CREATE TABLE ImagenesPostulante(
    idImagenPostulante INT AUTO_INCREMENT PRIMARY KEY,
    Postulante_idPostulante INT NOT NULL,
    nombreImagen VARCHAR(255) NOT NULL,
    urlImagen VARCHAR(255),
    FOREIGN KEY (Postulante_idPostulante) REFERENCES Postulante(idPostulante)
);

-- TABLA : Certificaciones y Habilidades
CREATE TABLE Certificaciones(
    idCertificacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    organizacionEmisora VARCHAR(45),
    fechaObtencion DATE,
    urlCredencial VARCHAR(100)
);

CREATE TABLE Postulante_Certificacion(
    Postulante_idPostulante INT NOT NULL,
    Certificaciones_idCertificacion INT NOT NULL,
    PRIMARY KEY (Postulante_idPostulante, Certificaciones_idCertificacion),
    FOREIGN KEY (Postulante_idPostulante) REFERENCES Postulante(idPostulante),
    FOREIGN KEY (Certificaciones_idCertificacion) REFERENCES Certificaciones(idCertificacion)
);

CREATE TABLE Habilidades(
    idHabilidad INT AUTO_INCREMENT PRIMARY KEY,
    nombreHabilidad VARCHAR(45)
);

CREATE TABLE Postulante_Habilidades(
    idPostulante_Habilidad INT AUTO_INCREMENT PRIMARY KEY,
    Postulante_idPostulante INT NOT NULL,
    Habilidades_idHabilidad INT NOT NULL,
    FOREIGN KEY (Postulante_idPostulante) REFERENCES Postulante(idPostulante),
    FOREIGN KEY (Habilidades_idHabilidad) REFERENCES Habilidades(idHabilidad)
);

-- TABLA : Sub-Vacantes
CREATE TABLE EstadoValidacionVacante(
    idEstadoValidacionVacante INT AUTO_INCREMENT PRIMARY KEY,
    estadoValidacionVacante VARCHAR(45)
);

INSERT INTO EstadoValidacionVacante(estadoValidacionVacante) VALUES ("Abierta"),("Cerrada"),("Pausada");

CREATE TABLE TipoContrato(
    idTipoContrato INT AUTO_INCREMENT PRIMARY KEY,
    estadoContrato VARCHAR(45)
);

INSERT INTO TipoContrato(estadoContrato) VALUES ("Tiempo Completo"),("Medio Tiempo"),("Por Proyecto"),("Pasantía");

CREATE TABLE TipoModalidad(
    idTipoModalidad INT AUTO_INCREMENT PRIMARY KEY,
    tipoModalidad VARCHAR(45)
);

INSERT INTO TipoModalidad(tipoModalidad) VALUES ("Presencial"),("Remoto"),("Híbrido");

-- TABLA : Vacantes
CREATE TABLE Vacantes(
    idVacante INT AUTO_INCREMENT PRIMARY KEY,
    Empresa_idEmpresa INT NOT NULL,
    EstadoValidacionVacante_idEstadoValidacionVacante INT NOT NULL,
    TipoContrato_idTipoContrato INT NOT NULL,
    TipoModalidad_idTipoModalidad INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    requisitos TEXT,
    ubicacion VARCHAR(255) NOT NULL,
    salario DECIMAL(10, 2),
    fechaPublicacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaLimite DATE,
    FOREIGN KEY (Empresa_idEmpresa) REFERENCES Empresas(idEmpresas),
    FOREIGN KEY (EstadoValidacionVacante_idEstadoValidacionVacante) REFERENCES EstadoValidacionVacante(idEstadoValidacionVacante),
    FOREIGN KEY (TipoContrato_idTipoContrato) REFERENCES TipoContrato(idTipoContrato),
    FOREIGN KEY (TipoModalidad_idTipoModalidad) REFERENCES TipoModalidad(idTipoModalidad)
);

-- TABLA : Sub-Postulaciones
CREATE TABLE EstadoPostulacion(
    idEstadoPostulacion INT AUTO_INCREMENT PRIMARY KEY,
    estadoPostulacion VARCHAR(45)
);

INSERT INTO EstadoPostulacion(estadoPostulacion) VALUES ("En revisión"),("Aceptada"),("Rechazada"),("Entrevista Programada");

-- TABLA : Postulaciones
CREATE TABLE Postulaciones(
    idPostulacion INT AUTO_INCREMENT PRIMARY KEY,
    Postulante_idPostulante INT NOT NULL,
    Vacante_idVacante INT NOT NULL,
    EstadoPostulacion_idEstadoPostulacion INT NOT NULL,
    fechaPostulacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Postulante_idPostulante) REFERENCES Postulante(idPostulante),
    FOREIGN KEY (Vacante_idVacante) REFERENCES Vacantes(idVacante),
    FOREIGN KEY (EstadoPostulacion_idEstadoPostulacion) REFERENCES EstadoPostulacion(idEstadoPostulacion)
);
