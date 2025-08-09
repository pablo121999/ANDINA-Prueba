-- Modelo de Datos

CREATE TABLE puntos_gestion (
    id_punto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(255),
    latitud DECIMAL(10,8) NOT NULL,
    longitud DECIMAL(11,8) NOT NULL,
    descripcion TEXT
);


CREATE TABLE visitas (
    id_visita INT PRIMARY KEY AUTO_INCREMENT,
    id_punto INT NOT NULL,
    fecha_visita DATETIME NOT NULL,
    hora_inicio DATETIME NOT NULL,
    hora_fin DATETIME NOT NULL,
    observaciones TEXT,
    FOREIGN KEY (id_punto) REFERENCES puntos_gestion(id_punto)
);



CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    cargo VARCHAR(100)
);


-- relacionarlo en visitas
ALTER TABLE visitas ADD id_usuario INT, 
ADD FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


-- Lógica Analítica
SELECT 
    p1.nombre AS punto1, 
    p2.nombre AS punto2,
    (6371 * ACOS(
        COS(RADIANS(p1.latitud)) * COS(RADIANS(p2.latitud)) * 
        COS(RADIANS(p2.longitud) - RADIANS(p1.longitud)) + 
        SIN(RADIANS(p1.latitud)) * SIN(RADIANS(p2.latitud))
    )) AS distancia_km
FROM puntos_gestion p1
JOIN puntos_gestion p2 ON p1.id_punto < p2.id_punto;


--Puntos con mayor cantidad de visitas
SELECT 
    p.nombre, 
    COUNT(v.id_visita) AS total_visitas
FROM visitas v
JOIN puntos_gestion p ON v.id_punto = p.id_punto
GROUP BY p.nombre
ORDER BY total_visitas DESC;


--Puntos con mayor tiempo promedio de visita
SELECT 
    p.nombre,
    AVG(TIMESTAMPDIFF(MINUTE, v.hora_inicio, v.hora_fin)) AS tiempo_promedio_min
FROM visitas v
JOIN puntos_gestion p ON v.id_punto = p.id_punto
GROUP BY p.nombre
ORDER BY tiempo_promedio_min DESC;
