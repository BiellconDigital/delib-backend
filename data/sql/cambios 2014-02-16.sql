CREATE TABLE cart_orden__tipo (__id_orden_tipo INT AUTO_INCREMENT NOT NULL, __activo TINYINT(1) DEFAULT NULL, PRIMARY KEY(__id_orden_tipo)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE cart_orden__tipo_language (__id_orden_tipo INT DEFAULT NULL, __id_language INT DEFAULT NULL, __id_OrdenTipo_Language INT AUTO_INCREMENT NOT NULL, __descripcion VARCHAR(140) NOT NULL, __detalle LONGTEXT DEFAULT NULL, INDEX IDX_AABC39539F6B78C6 (__id_orden_tipo), INDEX IDX_AABC395380E64D77 (__id_language), PRIMARY KEY(__id_OrdenTipo_Language)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE cart_orden__tipo_language ADD CONSTRAINT FK_AABC39539F6B78C6 FOREIGN KEY (__id_orden_tipo) REFERENCES cart_orden__tipo (__id_orden_tipo) ON DELETE CASCADE;
ALTER TABLE cart_orden__tipo_language ADD CONSTRAINT FK_AABC395380E64D77 FOREIGN KEY (__id_language) REFERENCES cms_language (__id_language) ON DELETE CASCADE;

ALTER TABLE cart_orden ADD __id_orden_tipo INT DEFAULT NULL, ADD __acepta_politica TINYINT(1) NOT NULL;
ALTER TABLE cart_orden ADD CONSTRAINT FK_BEC2A2DF9F6B78C6 FOREIGN KEY (__id_orden_tipo) REFERENCES cart_orden__tipo (__id_orden_tipo);
CREATE INDEX IDX_BEC2A2DF9F6B78C6 ON cart_orden (__id_orden_tipo);


INSERT INTO  `delibouquet`.`cart_orden__tipo_language` (
`__id_orden_tipo` ,
`__id_language` ,
`__id_OrdenTipo_Language` ,
`__descripcion` ,
`__detalle`
)
VALUES (
'1',  '1', NULL ,  'Cumpleaños', NULL
), (
'2',  '1', NULL ,  'Aniversario', NULL
);
INSERT INTO  `delibouquet`.`cart_orden__tipo_language` (
`__id_orden_tipo` ,
`__id_language` ,
`__id_OrdenTipo_Language` ,
`__descripcion` ,
`__detalle`
)
VALUES (
'3',  '1', NULL ,  'Nacimiento', NULL
), (
'4',  '1', NULL ,  'Regalo', NULL
);

INSERT INTO  `delibouquet`.`cms_ubigeo` (
`__cod_postal` ,
`__dpto` ,
`__prov` ,
`__dist` ,
`__cregion` ,
`__csubregion` ,
`__cod_dpto` ,
`__cod_prov` ,
`__id_Pais`
)
VALUES (
'150116',  'Lima',  'Lima',  'Lince', NULL , NULL , NULL , NULL ,  '1'
), (
'150131',  'Lima',  'Lima',  'San Isidro', NULL , NULL , NULL , NULL , NULL
);

INSERT INTO  `delibouquet`.`cms_ubigeo` (
`__cod_postal` ,
`__dpto` ,
`__prov` ,
`__dist` ,
`__cregion` ,
`__csubregion` ,
`__cod_dpto` ,
`__cod_prov` ,
`__id_Pais`
)
VALUES (
'150104',  'Lima',  'Lima',  'Barranco', NULL , NULL , NULL , NULL ,  '1'
), (
'150122',  'Lima',  'Lima',  'Miraflores', NULL , NULL , NULL , NULL ,  '1'
), (
'150130',  'Lima',  'Lima',  'San Borja', NULL , NULL , NULL , NULL ,  '1'
), (
'150141',  'Lima',  'Lima',  'Surquillo', NULL , NULL , NULL , NULL ,  '1'
), (
'150140',  'Lima',  'Lima',  'Santiago de Surco', NULL , NULL , NULL , NULL ,  '1'
);


ALTER TABLE cart_orden ADD __tipo_pago INT NOT NULL;


ALTER TABLE  `cms_cliente` CHANGE  `__apellido_paterno`  `__apellido_paterno` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;


