-- Asegurarse de que estamos usando la base de datos correcta
USE Futurework_ITT;

-- 1. Insertar Usuarios (Roles: 1=Empresa, 2=Postulante, 3=Admin)
-- Crearemos 2 empresas, 3 postulantes y 1 admin
INSERT INTO Usuarios(Rol_idRol, nombreCompleto, email, Password) VALUES
(1, 'Tech Solutions SA de CV', 'contacto@techsolutions.com', 'empresaPass123'),
(1, 'Innovatec Global', 'hr@innovatec.com', 'innovatecPass456'),
(2, 'Ana Sofía Pérez', 'ana.perez@email.com', 'anaPass789'),
(2, 'Carlos Alberto Gómez', 'carlos.gomez@email.com', 'carlosPass101'),
(2, 'María Fernanda López', 'maria.lopez@email.com', 'mariaPass112'),
(3, 'Administrador General', 'admin@futurework.com', 'adminSecurePass'),
(1, 'Juarez Duran Luis Yahir', 'admin2@futurework.com', 'fdsf1234');

-- IDs de Usuarios generados:
-- 1: Tech Solutions (Empresa)
-- 2: Innovatec Global (Empresa)
-- 3: Ana Pérez (Postulante)
-- 4: Carlos Gómez (Postulante)
-- 5: María López (Postulante)
-- 6: Admin General (Admin)

-- 2. Insertar Carreras
INSERT INTO Carrera(nombreCarrera) VALUES
('Ingeniería en Sistemas Computacionales'),
('Ingeniería Industrial'),
('Ingeniería en Gestión Empresarial'),
('Ingeniería Mecatrónica'),
('Licenciatura en Administración');

-- IDs de Carreras generados:
-- 1: Sistemas
-- 2: Industrial
-- 3: Gestión
-- 4: Mecatrónica
-- 5: Administración

-- 3. Insertar Empresas (Estados: 1=Pendiente, 2=Validado, 3=Rechazado)
-- Vinculamos a los Usuarios con Rol_idRol = 1
INSERT INTO Empresas(Usuarios_idUsuarios, EstadoValidacionEmpresa_idEstadoValidacionEmpresa, nombreEmpresa, sector, representante, descripcion, sitioWeb) VALUES
(1, 2, 'Tech Solutions SA de CV', 'Tecnología', 'Juan Robles', 'Empresa de desarrollo de software a medida.', 'https://techsolutions.com'),
(2, 1, 'Innovatec Global', 'Consultoría TI', 'Laura Méndez', 'Consultoría de servicios TI y outsourcing.', 'https://innovatec.com'),
(7, 2, 'CNX', 'Tecnología', 'Pedro Sanchez', 'Empresa de desarrollo de instalaciones de internet.', 'https://techsolutions.com');

-- IDs de Empresas generados:
-- 1: Tech Solutions (Usuario 1, Validado)
-- 2: Innovatec Global (Usuario 2, Pendiente)

-- 4. Insertar Postulantes
-- Vinculamos a los Usuarios con Rol_idRol = 2
INSERT INTO Postulante(Carrera_idCarrera, Usuarios_idUsuarios, numeroControl, cvPath, telefono, ubicacion) VALUES
(1, 3, '18270123', '/cvs/ana_perez.pdf', '222-123-4567', 'Puebla, México'),
(2, 4, '17270456', '/cvs/carlos_gomez.pdf', '555-987-6543', 'CDMX, México'),
(1, 5, '19270789', '/cvs/maria_lopez.pdf', '333-456-7890', 'Guadalajara, México');

-- IDs de Postulantes generados:
-- 1: Ana Pérez (Usuario 3, Carrera 1)
-- 2: Carlos Gómez (Usuario 4, Carrera 2)
-- 3: María López (Usuario 5, Carrera 1)

-- 5. Insertar Imágenes de Perfil (Empresa y Postulante)
-- 5. Insertar Imagen de Perfil de Empresa
INSERT INTO EmpresaImagenPerfil (Nombre, rutaImagenPerfilEmpresa) VALUES
('Logo Principal', '/img/empresa/1/profile_logo.png');

INSERT INTO ImagenPerfilEmpresa (Empresas_idEmpresas, EmpresaPerfilImagen_idEmpresaPerfilImagen) VALUES
(1, 1);

-- 6. Insertar Imagen de Perfil de Postulante
INSERT INTO PostulanteImagenPerfil (nombreImagen, rutaImagenPerfilPostulante) VALUES
('ana_perfil.jpg', '/img/postulante/1/ana_perfil.jpg'),
('carlos_perfil.png', '/img/postulante/2/carlos_perfil.png');

INSERT INTO ImagenesPerfilPostulante (Postulante_idPostulante, PostulanteImagenPerfil_idImagenPerfilPostulante) VALUES
(1, 1),
(2, 2);

-- 7. Insertar Imágenes Adicionales (Galería de Empresa y Postulante)
INSERT INTO ImagenesEmpresa (Empresas_idEmpresas, rutaImagenEmpresa, urlImagen) VALUES
(1, '/img/empresa/1/oficinas.jpg', NULL),
(1, '/img/empresa/1/equipo.jpg', NULL);

INSERT INTO ImagenesPostulante (Postulante_idPostulante, nombreImagen, urlImagen) VALUES
(1, 'proyecto_hackaton.jpg', '/img/postulante/1/proyecto_hackaton.jpg');

-- 7. Insertar Habilidades (Catálogo)
INSERT INTO Habilidades(nombreHabilidad) VALUES
('Java'),
('Python'),
('C#'),
('SQL Server'),
('MySQL'),
('React'),
('Angular'),
('Docker'),
('Liderazgo'),
('Comunicación Asertiva');

-- IDs de Habilidades: 1=Java, 2=Python, 3=C#, 4=SQL Server, 5=MySQL, 6=React, 7=Angular, 8=Docker, 9=Liderazgo, 10=Comunicación

-- 8. Vincular Habilidades a Postulantes (Postulante_Habilidades)
INSERT INTO Postulante_Habilidades(Postulante_idPostulante, Habilidades_idHabilidad) VALUES
(1, 1), -- Ana: Java
(1, 5), -- Ana: MySQL
(1, 6), -- Ana: React
(1, 10), -- Ana: Comunicación
(2, 4), -- Carlos: SQL Server
(2, 9), -- Carlos: Liderazgo
(3, 1), -- María: Java
(3, 3), -- María: C#
(3, 4), -- María: SQL Server
(3, 8); -- María: Docker

-- 9. Insertar Certificaciones (Catálogo)
INSERT INTO Certificaciones(nombre, organizacionEmisora, fechaObtencion, urlCredencial) VALUES
('Scrum Master Certified (SMC)', 'Scrum Alliance', '2023-05-15', '/certs/smc123'),
('AWS Certified Cloud Practitioner', 'Amazon Web Services', '2024-01-20', '/certs/aws456'),
('Microsoft Certified: Azure Fundamentals (AZ-900)', 'Microsoft', '2023-11-10', '/certs/az900');

-- IDs de Certificaciones: 1=Scrum, 2=AWS, 3=Azure

-- 10. Vincular Certificaciones a Postulantes (Postulante_Certificacion)
INSERT INTO Postulante_Certificacion(Postulante_idPostulante, Certificaciones_idCertificacion) VALUES
(1, 2), -- Ana tiene AWS
(3, 1), -- María tiene Scrum
(3, 3); -- María tiene Azure

-- 11. Insertar Vacantes
-- Empresa_idEmpresa: 1 (Tech Solutions)
-- EstadoValidacionVacante: 1=Abierta, 2=Cerrada, 3=Pausada
-- TipoContrato: 1=Tiempo Completo, 2=Medio Tiempo, 3=Por Proyecto, 4=Pasantía
-- TipoModalidad: 1=Presencial, 2=Remoto, 3=Híbrido
INSERT INTO Vacantes(Empresa_idEmpresa, EstadoValidacionVacante_idEstadoValidacionVacante, TipoContrato_idTipoContrato, TipoModalidad_idTipoModalidad, titulo, descripcion, requisitos, ubicacion, salario, fechaLimite) VALUES
(1, 1, 1, 3, 'Desarrollador Java Sr.', 'Buscamos un Dev. Java con 5 años de exp. para proyecto bancario.', 'Java 11+, Spring Boot, Microservicios, MySQL, AWS Básico.', 'Puebla, México (Híbrido)', 45000.00, '2025-12-15'),
(1, 1, 2, 2, 'Desarrollador React Jr.', 'Desarrollador Frontend para mantenimiento de app interna.', 'React, Hooks, CSS, API REST.', 'Remoto (México)', 22000.00, '2025-12-01'),
(1, 2, 4, 1, 'Pasante de QA', 'Apoyo en pruebas funcionales y automatizadas (ya cubierta).', 'Estudiante de últimos semestres.', 'Puebla, México (Presencial)', 6000.00, '2025-11-01');

-- IDs de Vacantes generados:
-- 1: Java Sr. (Abierta, Híbrido)
-- 2: React Jr. (Abierta, Remoto)
-- 3: Pasante QA (Cerrada, Presencial)

-- 12. Insertar Postulaciones
-- Postulante_idPostulante: 1=Ana, 2=Carlos, 3=María
-- Vacante_idVacante: 1=Java, 2=React, 3=QA
-- EstadoPostulacion: 1=En revisión, 2=Aceptada, 3=Rechazada, 4=Entrevista
INSERT INTO Postulaciones(Postulante_idPostulante, Vacante_idVacante, EstadoPostulacion_idEstadoPostulacion) VALUES
(1, 1, 1, NOW() - INTERVAL 5 DAY), -- Ana aplicó a Java Sr. (En revisión)
(1, 2, 4, NOW() - INTERVAL 4 DAY), -- Ana aplicó a React Jr. (Entrevista Programada)
(3, 1, 2, NOW() - INTERVAL 3 DAY), -- María aplicó a Java Sr. (Aceptada)
(2, 2, 3, NOW() - INTERVAL 10 DAY); -- Carlos aplicó a React Jr. (Rechazado)

-- 1. Insertar 10 nuevos Usuarios (Rol 2 = Postulante)
-- Se asume que los IDs generados irán del 8 al 17, ya que el último insertado fue el 7.
INSERT INTO Usuarios(Rol_idRol, nombreCompleto, email, Password) VALUES
(2, 'Diego Ramírez', 'diego.ramirez@email.com', 'pass1234'),
(2, 'Valeria Torres', 'valeria.torres@email.com', 'pass1234'),
(2, 'Jorge Silva', 'jorge.silva@email.com', 'pass1234'),
(2, 'Lucía Fernández', 'lucia.fernandez@email.com', 'pass1234'),
(2, 'Roberto Castro', 'roberto.castro@email.com', 'pass1234'),
(2, 'Mónica Herrera', 'monica.herrera@email.com', 'pass1234'),
(2, 'Andrés Navarro', 'andres.navarro@email.com', 'pass1234'),
(2, 'Daniela Vargas', 'daniela.vargas@email.com', 'pass1234'),
(2, 'Miguel Ortiz', 'miguel.ortiz@email.com', 'pass1234'),
(2, 'Elena Ríos', 'elena.rios@email.com', 'pass1234');

-- 2. Insertar los 10 Postulantes asociados a los Usuarios
-- Las carreras van del 1 al 5 (Sistemas, Industrial, Gestión, Mecatrónica, Administración)
-- Los IDs de postulante generados serán del 4 al 13.
INSERT INTO Postulante(Carrera_idCarrera, Usuarios_idUsuarios, numeroControl, cvPath, telefono, ubicacion) VALUES
(1, 8, '21270101', '/cvs/diego_ramirez.pdf', '238-111-2233', 'Tehuacán, Puebla'),
(2, 9, '21270102', '/cvs/valeria_torres.pdf', '238-222-3344', 'Tehuacán, Puebla'),
(4, 10, '20270103', '/cvs/jorge_silva.pdf', '222-333-4455', 'Puebla, Puebla'),
(5, 11, '19270104', '/cvs/lucia_fernandez.pdf', '555-444-5566', 'CDMX, México'),
(1, 12, '21270105', '/cvs/roberto_castro.pdf', '238-555-6677', 'Tehuacán, Puebla'),
(3, 13, '22270106', '/cvs/monica_herrera.pdf', '222-666-7788', 'Puebla, Puebla'),
(4, 14, '20270107', '/cvs/andres_navarro.pdf', '333-777-8899', 'Guadalajara, Jalisco'),
(1, 15, '21270108', '/cvs/daniela_vargas.pdf', '238-888-9900', 'Tehuacán, Puebla'),
(2, 16, '19270109', '/cvs/miguel_ortiz.pdf', '229-999-0011', 'Orizaba, Veracruz'),
(5, 17, '22270110', '/cvs/elena_rios.pdf', '238-000-1122', 'Tehuacán, Puebla');

-- 3. (Opcional) Vincular habilidades a algunos de los nuevos postulantes para enriquecer la data
-- IDs Postulantes nuevos: 4 a 13. Habilidades existentes: 1 al 10.
INSERT INTO Postulante_Habilidades(Postulante_idPostulante, Habilidades_idHabilidad) VALUES
(4, 1), (4, 5), (4, 8),   -- Diego (Sistemas): Java, MySQL, Docker
(5, 9), (5, 10),          -- Valeria (Industrial): Liderazgo, Comunicación
(6, 2), (6, 3),           -- Jorge (Mecatrónica): Python, C#
(8, 5), (8, 6), (8, 7),   -- Roberto (Sistemas): MySQL, React, Angular
(11, 2), (11, 5), (11, 8);-- Daniela (Sistemas): Python, MySQL, Docker

-- 1. Insertar nuevas Certificaciones al catálogo
-- Estos se sumarán a los IDs 1 (Scrum), 2 (AWS) y 3 (Azure) que ya tenías.
-- Asumimos que estos nuevos registros tomarán los IDs 4, 5, 6 y 7.
INSERT INTO Certificaciones(nombre, organizacionEmisora, fechaObtencion, urlCredencial) VALUES
('Linux Foundation Certified System Administrator (LFCS)', 'The Linux Foundation', '2025-03-10', '/certs/lfcs789'),
('Oracle Certified Professional, MySQL 8.0', 'Oracle', '2026-01-22', '/certs/mysql101'),
('Cisco Certified Network Associate (CCNA)', 'Cisco', '2024-08-05', '/certs/ccna202'),
('EF SET English Certificate 70/100 (C1 Advanced)', 'EF Standard English Test', '2025-06-15', '/certs/efset303');

-- 2. Vincular Certificaciones a los nuevos Postulantes
-- IDs Postulantes nuevos: 4 a 13.
INSERT INTO Postulante_Certificacion(Postulante_idPostulante, Certificaciones_idCertificacion) VALUES
(4, 2),  -- Diego (Sistemas): AWS Certified Cloud Practitioner
(4, 5),  -- Diego (Sistemas): Oracle Certified Professional, MySQL 8.0
(6, 6),  -- Jorge (Mecatrónica): CCNA
(8, 4),  -- Roberto (Sistemas): LFCS (Linux)
(9, 1),  -- Lucía (Gestión Empresarial): Scrum Master Certified (SMC)
(11, 3), -- Daniela (Sistemas): Microsoft Certified: Azure Fundamentals
(11, 7), -- Daniela (Sistemas): Inglés C1
(13, 7); -- Elena (Administración): Inglés C1

USE Futurework_ITT;

-- 1. Insertar 10 nuevos Usuarios (Rol 2 = Postulante)
-- Los IDs generados irán del 18 al 27.
INSERT INTO Usuarios(Rol_idRol, nombreCompleto, email, Password) VALUES
(2, 'Fernando Ayala', 'fernando.ayala@email.com', 'pass1234'),
(2, 'Camila Rojas', 'camila.rojas@email.com', 'pass1234'),
(2, 'Hugo Mendoza', 'hugo.mendoza@email.com', 'pass1234'),
(2, 'Sofía Beltrán', 'sofia.beltran@email.com', 'pass1234'),
(2, 'Pedro Carmona', 'pedro.carmona@email.com', 'pass1234'),
(2, 'Natalia Fuentes', 'natalia.fuentes@email.com', 'pass1234'),
(2, 'Arturo Domínguez', 'arturo.dominguez@email.com', 'pass1234'),
(2, 'Blanca Soto', 'blanca.soto@email.com', 'pass1234'),
(2, 'Raúl Espinoza', 'raul.espinoza@email.com', 'pass1234'),
(2, 'Ximena Cortez', 'ximena.cortez@email.com', 'pass1234');

-- 2. Insertar los 10 Postulantes asociados
-- Los IDs de postulante generados serán del 14 al 23.
-- Ubicaciones enfocadas en la región y alrededores.
INSERT INTO Postulante(Carrera_idCarrera, Usuarios_idUsuarios, numeroControl, cvPath, telefono, ubicacion) VALUES
(1, 18, '20270201', '/cvs/fernando_ayala.pdf', '238-123-1111', 'Tehuacán, Puebla'),
(2, 19, '21270202', '/cvs/camila_rojas.pdf', '222-123-2222', 'Puebla, Puebla'),
(4, 20, '19270203', '/cvs/hugo_mendoza.pdf', '238-123-3333', 'Tehuacán, Puebla'),
(3, 21, '22270204', '/cvs/sofia_beltran.pdf', '222-123-4444', 'Cholula, Puebla'),
(5, 22, '21270205', '/cvs/pedro_carmona.pdf', '238-123-5555', 'Tehuacán, Puebla'),
(1, 23, '20270206', '/cvs/natalia_fuentes.pdf', '555-123-6666', 'CDMX, México'),
(2, 24, '21270207', '/cvs/arturo_dominguez.pdf', '238-123-7777', 'Tehuacán, Puebla'),
(4, 25, '19270208', '/cvs/blanca_soto.pdf', '229-123-8888', 'Orizaba, Veracruz'),
(1, 26, '20270209', '/cvs/raul_espinoza.pdf', '238-123-9999', 'Tehuacán, Puebla'),
(5, 27, '22270210', '/cvs/ximena_cortez.pdf', '222-123-0000', 'Puebla, Puebla');

-- 3. Insertar nuevas Habilidades al catálogo
-- Se sumarán a los IDs del 1 al 10. Estas nuevas tomarán los IDs del 11 al 15.
INSERT INTO Habilidades(nombreHabilidad) VALUES
('PHP'),
('MariaDB'),
('Flutter'),
('Ensamblador x86'),
('Linux');

-- 4. Vincular Habilidades a los Postulantes
-- IDs Postulantes: 14 a 23.
INSERT INTO Postulante_Habilidades(Postulante_idPostulante, Habilidades_idHabilidad) VALUES
(14, 11), (14, 12), (14, 15), -- Fernando (Sistemas): PHP, MariaDB, Linux
(16, 2), (16, 14), (16, 15),  -- Hugo (Mecatrónica): Python, Ensamblador x86, Linux
(19, 13), (19, 6), (19, 1),   -- Natalia (Sistemas): Flutter, React, Java
(21, 14), (21, 8), (21, 15),  -- Blanca (Mecatrónica): Ensamblador x86, Docker, Linux
(22, 11), (22, 12), (22, 5),  -- Raúl (Sistemas): PHP, MariaDB, MySQL
(15, 9), (15, 10),            -- Camila (Industrial): Liderazgo, Comunicación
(17, 10),                     -- Sofía (Gestión): Comunicación
(18, 9), (18, 10);            -- Pedro (Administración): Liderazgo, Comunicación

-- 5. Vincular Certificaciones a los Postulantes
-- Utilizando el catálogo existente de certificaciones (IDs 1 al 7).
INSERT INTO Postulante_Certificacion(Postulante_idPostulante, Certificaciones_idCertificacion) VALUES
(14, 4), -- Fernando (Sistemas): LFCS (Linux)
(14, 5), -- Fernando (Sistemas): MySQL 8.0
(16, 6), -- Hugo (Mecatrónica): CCNA
(17, 1), -- Sofía (Gestión): Scrum Master Certified
(19, 2), -- Natalia (Sistemas): AWS
(22, 4), -- Raúl (Sistemas): LFCS (Linux)
(23, 7); -- Ximena (Administración): Inglés C1

USE Futurework_ITT;

-- 1. Insertar nuevas Habilidades al catálogo
-- Se sumarán a los IDs del 1 al 15. Estas nuevas tomarán los IDs del 16 al 20.
INSERT INTO Habilidades(nombreHabilidad) VALUES
('Arquitectura Limpia'),
('C/C++'),
('Ollama / IA Local'),
('Desarrollo Backend'),
('OpenCore / Hardware Modding');

-- 2. Insertar 10 nuevos Usuarios (Rol 2 = Postulante)
-- Se asume que los IDs generados irán del 28 al 37.
INSERT INTO Usuarios(Rol_idRol, nombreCompleto, email, Password) VALUES
(2, 'Andrés Silva', 'andres.silva@email.com', 'pass1234'),
(2, 'Mariana Cruz', 'mariana.cruz@email.com', 'pass1234'),
(2, 'Héctor Jiménez', 'hector.jimenez@email.com', 'pass1234'),
(2, 'Lorena Paz', 'lorena.paz@email.com', 'pass1234'),
(2, 'Óscar Medina', 'oscar.medina@email.com', 'pass1234'),
(2, 'Paola Salazar', 'paola.salazar@email.com', 'pass1234'),
(2, 'Ignacio Vega', 'ignacio.vega@email.com', 'pass1234'),
(2, 'Teresa Mora', 'teresa.mora@email.com', 'pass1234'),
(2, 'Samuel Ríos', 'samuel.rios@email.com', 'pass1234'),
(2, 'Diana Ortiz', 'diana.ortiz@email.com', 'pass1234');

-- 3. Insertar los 10 Postulantes asociados
-- Los IDs de postulante generados serán del 24 al 33.
-- Utilizamos matrículas secuenciales nuevas para evitar conflictos con la restricción UNIQUE.
INSERT INTO Postulante(Carrera_idCarrera, Usuarios_idUsuarios, numeroControl, cvPath, telefono, ubicacion) VALUES
(1, 28, '22270301', '/cvs/andres_silva.pdf', '238-555-1001', 'Tehuacán, Puebla'),
(2, 29, '21270302', '/cvs/mariana_cruz.pdf', '238-555-1002', 'Tehuacán, Puebla'),
(1, 30, '20270303', '/cvs/hector_jimenez.pdf', '222-555-1003', 'Puebla, Puebla'),
(4, 31, '19270304', '/cvs/lorena_paz.pdf', '238-555-1004', 'Tehuacán, Puebla'),
(3, 32, '21270305', '/cvs/oscar_medina.pdf', '229-555-1005', 'Orizaba, Veracruz'),
(1, 33, '22270306', '/cvs/paola_salazar.pdf', '238-555-1006', 'Tehuacán, Puebla'),
(1, 34, '20270307', '/cvs/ignacio_vega.pdf', '238-555-1007', 'Tehuacán, Puebla'),
(5, 35, '21270308', '/cvs/teresa_mora.pdf', '222-555-1008', 'Cholula, Puebla'),
(4, 36, '19270309', '/cvs/samuel_rios.pdf', '238-555-1009', 'Tehuacán, Puebla'),
(2, 37, '22270310', '/cvs/diana_ortiz.pdf', '238-555-1010', 'Tehuacán, Puebla');

-- 4. Vincular Habilidades a los Postulantes
-- Utilizando el catálogo completo (IDs 1 al 20).
INSERT INTO Postulante_Habilidades(Postulante_idPostulante, Habilidades_idHabilidad) VALUES
(24, 11), (24, 12), (24, 19), (24, 16), -- Andrés (Sistemas): PHP, MariaDB, Des. Backend, Arquitectura Limpia
(25, 9), (25, 10),                      -- Mariana (Industrial): Liderazgo, Comunicación
(26, 17), (26, 14), (26, 15),           -- Héctor (Sistemas): C/C++, Ensamblador x86, Linux
(27, 2), (27, 17),                      -- Lorena (Mecatrónica): Python, C/C++
(28, 9), (28, 10),                      -- Óscar (Gestión): Liderazgo, Comunicación
(29, 6), (29, 7), (29, 1),              -- Paola (Sistemas): React, Angular, Java
(30, 18), (30, 2), (30, 15), (30, 8),   -- Ignacio (Sistemas): Ollama/IA Local, Python, Linux, Docker
(31, 10),                               -- Teresa (Administración): Comunicación
(32, 20), (32, 17), (32, 15),           -- Samuel (Mecatrónica): OpenCore/Modding, C/C++, Linux
(33, 9);                                -- Diana (Industrial): Liderazgo

-- 5. Vincular Certificaciones a los Postulantes
INSERT INTO Postulante_Certificacion(Postulante_idPostulante, Certificaciones_idCertificacion) VALUES
(24, 5), -- Andrés (Sistemas): MySQL 8.0
(26, 4), -- Héctor (Sistemas): LFCS (Linux)
(30, 2), -- Ignacio (Sistemas): AWS
(30, 4), -- Ignacio (Sistemas): LFCS (Linux)
(33, 1); -- Diana (Industrial): Scrum Master