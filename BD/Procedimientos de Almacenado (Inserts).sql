DELIMITER //

CREATE PROCEDURE InsertarCliente (
    IN Id BIGINT (20),
    IN nombre VARCHAR(45),
    IN correo VARCHAR(100),
    IN telefono VARCHAR(12))
BEGIN
    INSERT INTO ga_cliente (pk_id_cliente, cliNombre, cliCorreo, cliTelefono)
    VALUES (Id, nombre, correo, telefono);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarUsuario (
    IN Id BIGINT (20),
    IN Nombre VARCHAR(100),
    IN Apellido VARCHAR(100),
    IN EPS VARCHAR(100),
    IN ARL VARCHAR(100),
    IN Fecha_nacimiento DATE,
    IN Municipio VARCHAR(50),
    IN Direccion VARCHAR(100),
    IN Profesion VARCHAR(50),
    IN Contrasenia VARCHAR(45),
    IN Telefono VARCHAR(12),
    IN Correo VARCHAR(60),
    IN IdRol INT (11)
)
BEGIN
    INSERT INTO Usuario (pk_id_usuario, usuNombre, usuApellido, usuNombre_eps, 
    usuNombre_arl, usuFecha_nacimiento, usuMunicipio, usuDireccion_residencia, usuProfesion, 
    usuContrasenia, usuTelefono, usuCorreo)
    VALUES (Id, Nombre, Apellido, EPS, ARL, Fecha_nacimiento, Municipio, Direccion, Profesion, Contrasenia, Telefono, Correo);
    
    INSERT INTO usuarios_roles (fk_id_rol, fk_id_usuario)
    VALUES (IdRol, Id);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarProyecto (
    IN nombre VARCHAR(100),
    IN municipio VARCHAR(50),
    IN direccion VARCHAR(100),
    IN descripcion VARCHAR(5000),
    IN ruta VARCHAR(280),
    IN cliente BIGINT (20))
BEGIN
    INSERT INTO ga_proyecto (proNombre, proMunicipio, proDireccion, proDescripcion, proRuta, fk_id_cliente)
    VALUES (nombre, municipio, direccion, descripcion, ruta, cliente);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarCarpeta (
    IN nombre VARCHAR(100),
    IN ruta VARCHAR(280),
    IN clave VARCHAR(20),
    IN descripcion VARCHAR(5000),
    IN autor BIGINT (20),
    IN proyecto BIGINT (20))
BEGIN
    INSERT INTO ga_carpeta (carNombre, carRuta, carEtiqueta, carDescripcion, fk_id_usuario, fk_id_proyecto)
    VALUES (nombre, ruta, clave, descripcion, autor, proyecto);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarArchivo (
    IN nombreOriginal VARCHAR(100),
    IN ruta VARCHAR(280),
    IN tipo VARCHAR(45),
    IN tamaño VARCHAR(45),
    IN etiqueta VARCHAR(20),
    IN autor BIGINT,
    IN carpeta BIGINT,
    IN origen BIGINT)
BEGIN
    DECLARE archivo BIGINT;
    
    INSERT INTO ga_archivo (arcNombre_Original, arcRuta, arcTipo, arcTamaño, arcEtiqueta, fk_id_usuario, fk_id_carpeta)
    VALUES (nombreOriginal, ruta, tipo, tamaño, etiqueta, autor, carpeta);
    
    SET archivo = LAST_INSERT_ID();
    
    IF origen IS NULL THEN
        INSERT INTO ga_archivoversion (verArchivoOriginal, verArchivoVersion)
        VALUES (archivo, archivo);
    ELSE
        INSERT INTO ga_archivoversion (verArchivoOriginal, verArchivoVersion)
        VALUES (origen, archivo);
    END IF;
    
    COMMIT;
END//

CREATE PROCEDURE InsertarUsuariosAProyectos (
    IN usuario BIGINT,
    IN proyecto BIGINT)
BEGIN
    INSERT INTO usuarios_proyectos (fk_id_usuario, fk_id_proyecto)
    VALUES (usuario, proyecto);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarFase (
    IN nombre VARCHAR(100),
    IN descripcion VARCHAR(5000),
    IN estado ENUM ('PENDIENTE','EN PROGRESO','COMPLETADO'),
    IN proyecto BIGINT (20))
BEGIN
    INSERT INTO gt_fase (fasNombre, fasDescripcion, fasEstado, fk_id_proyecto)
    VALUES (nombre, descripcion, estado, proyecto);
    
    COMMIT;
END//

CREATE PROCEDURE InsertarTarea(
	IN nombre VARCHAR(45),
    IN descripcion VARCHAR(5000),
    IN prioridad ENUM ('ALTA','BAJA'),
    IN estado ENUM ('PENDIENTE','EN PROGRESO','COMPLETADO'),
    IN fechalimite DATETIME,
    IN fase BIGINT,
    IN tareadependiente BIGINT 
)
BEGIN
	DECLARE idtarea BIGINT;
	INSERT INTO gt_tarea (tarNombre, tarDescripcion, tarPrioridad, tarEstado, tarFecha_limite, fk_id_fase)
    VALUES (nombre, descripcion, prioridad, estado, fechalimite, fase);
    SET idtarea= LAST_INSERT_ID();
    IF tareadependiente IS NULL THEN 
    INSERT INTO gt_dependenciatareas (depTareaPrincipal, depTareaDependiente)
    VALUES (idtarea, idtarea);
    ELSE
    INSERT INTO gt_dependenciatareas (depTareaPrincipal, depTareaDependiente)
    VALUES (idtarea, tareadependiente);
    END IF;
    COMMIT;
    END//
    
    CREATE PROCEDURE InsertarUsuariosTareas(
    IN usuario BIGINT,
    IN tarea BIGINT
    )
    
    BEGIN 
		INSERT INTO usuarios_gt_tareas(fk_id_usuario, fk_id_tarea)
        VALUES (usuario, tarea);
        COMMIT;
        END//

CREATE PROCEDURE InsertarIncidente(
	IN nombre VARCHAR(280),
    IN descripcion VARCHAR(5000),
    IN estado ENUM ('INICIALIZADO','FINALIZADO'),
    IN gravedad ENUM ('ALTO','MEDIO','BAJO'),
	IN sugerencia varchar(5000),
    IN autor bigint,
    IN proyecto bigint
)        
BEGIN
INSERT INTO gii_incidente (incNombre, incDescripcion, incEstado, incGravedad, incSugerencias, fk_id_usuario, fk_id_proyecto)
VALUES (nombre, descripcion, estado, gravedad, sugerencia, autor, proyecto);
COMMIT;
END//

CREATE PROCEDURE InsertarInspeccion(
    IN nombre VARCHAR(280),
    IN descripcion VARCHAR(5000),
    IN estado ENUM('PENDIENTE','EN PROGRESO','COMPLETADO'),
    IN fecha DATETIME,
    IN periodicidad ENUM('DIARIA', 'SEMANAL','MENSUAL', 'NINGUNA'),
    IN fecha_final DATETIME,
    IN autor BIGINT,
    IN proyecto BIGINT,
    IN inspector BIGINT
)
BEGIN
    DECLARE idInspeccion BIGINT;
    
    IF periodicidad = 'NINGUNA' THEN
        SET fecha_final = fecha; -- Asignar el mismo valor que fecha
    END IF;
    
    INSERT INTO gii_inspeccion (insNombre, insDescripcion, insEstado, insFecha_inicial, insPeriodicidad, insFecha_final, fk_id_usuario, fk_id_proyecto)
    VALUES (nombre, descripcion, estado, fecha, periodicidad, fecha_final, autor, proyecto);
    
    SET idInspeccion = LAST_INSERT_ID();
    
    -- Verificar si el inspector no es nulo antes de realizar la inserción
    IF inspector IS NOT NULL THEN
        INSERT INTO usuarios_gii_inspecciones (fk_id_usuario, fk_id_inspeccion)
        VALUES (inspector, idInspeccion);
    END IF;
    
    COMMIT;
END//

    
CREATE PROCEDURE InsertarInvolucrado(
    IN numero_documento BIGINT,
    IN nombre VARCHAR(280),
    IN apellido VARCHAR(280),
    IN justificacion VARCHAR(200),
    IN incidente BIGINT
)
BEGIN
    DECLARE usuario_existente INT;
    DECLARE usuario_nombre VARCHAR(280);
    DECLARE usuario_apellido VARCHAR(280);
    DECLARE last_incidente BIGINT;

    -- Verificar si el número de documento existe en la tabla de usuarios
    SELECT COUNT(*) INTO usuario_existente
    FROM usuario
    WHERE pk_id_usuario = numero_documento;

    -- Si el usuario existe, obtener su nombre y apellido
    IF usuario_existente > 0 THEN
        SELECT usuNombre, usuApellido INTO usuario_nombre, usuario_apellido
        FROM usuario
        WHERE pk_id_usuario = numero_documento;
    ELSE
        SET usuario_nombre = nombre;
        SET usuario_apellido = apellido;
    END IF;

    -- Si se proporciona el incidente manualmente, úsalo; de lo contrario, obtén el último incidente
    IF incidente IS NOT NULL THEN
        SET last_incidente = incidente;
    ELSE
        -- Obtener el último incidente reportado
        SELECT MAX(pk_id_incidente) INTO last_incidente
        FROM gii_involucrado;
    END IF;

    -- Insertar en la tabla gii_involucrado
    INSERT INTO gii_involucrado (invNombre, invApellido, invNumDocumento, invJustificacion, fk_id_incidente)
    VALUES (usuario_nombre, usuario_apellido, numero_documento, justificacion, last_incidente);

    COMMIT;
END//

CREATE PROCEDURE InsertarSeguimiento(
IN descripcion VARCHAR(5000),
IN Sugerencias VARCHAR(5000),
IN Incidente BIGINT
)

BEGIN
INSERT INTO gii_seguimiento (actDescripcion, actSugerencia, fk_id_incidente)
VALUES (descripcion, Sugerencias, Incidente);
COMMIT;
END//

CREATE PROCEDURE actualizar_inspeccionProgramada(
    IN p_pk_id_inspeccion BIGINT,
    IN p_insNombre varchar(280),
    IN p_insDescripcion varchar(5000),
    IN p_insEstado ENUM('PENDIENTE', 'EN PROGRESO', 'COMPLETADO'),
    IN p_insFecha_inicial DATETIME,
    IN p_insPeriodicidad ENUM('DIARIA', 'SEMANAL', 'MENSUAL'),
    IN p_insFecha_final DATETIME
)
BEGIN
    UPDATE gii_inspeccion
    SET
        insNombre = p_insNombre,
        insDescripcion = p_insDescripcion,
        insEstado = p_insEstado,
        insFecha_inicial = p_insFecha_inicial,
        insPeriodicidad = p_insPeriodicidad,
        insFecha_final = p_insFecha_final
    WHERE
        pk_id_inspeccion = p_pk_id_inspeccion;

    -- No actualizamos las llaves foráneas
commit;

END //

DELIMITER ;
