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
(1, 'Wendy Paola Ramoz Lopez', 'admin@futurework.com', 'fdsf1234');

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
(7, 2, 'Wendy Paola Ramoz Lopez', 'Tecnología', 'Wendy Paola Ramoz Lopez', 'Empresa de desarrollo de software a medida.', 'https://techsolutions.com');

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
INSERT INTO Postulaciones(Postulante_idPostulante, Vacante_idVacante, EstadoPostulacion_idEstadoPostulacion, fechaPostulacion) VALUES
(1, 1, 1, NOW() - INTERVAL 5 DAY), -- Ana aplicó a Java Sr. (En revisión)
(1, 2, 4, NOW() - INTERVAL 4 DAY), -- Ana aplicó a React Jr. (Entrevista Programada)
(3, 1, 2, NOW() - INTERVAL 3 DAY), -- María aplicó a Java Sr. (Aceptada)
(2, 2, 3, NOW() - INTERVAL 10 DAY); -- Carlos aplicó a React Jr. (Rechazado)