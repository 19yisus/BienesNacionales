PGDMP         )                y            BienesNacionales #   12.7 (Ubuntu 12.7-0ubuntu0.20.04.1) #   12.7 (Ubuntu 12.7-0ubuntu0.20.04.1) r    U           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            V           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            W           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            X           1262    16385    BienesNacionales    DATABASE     ?   CREATE DATABASE "BienesNacionales" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_VE.UTF-8' LC_CTYPE = 'es_VE.UTF-8';
 "   DROP DATABASE "BienesNacionales";
                postgres    false            ?           1247    17957    tipo    TYPE     W   CREATE TYPE public.tipo AS ENUM (
    'muebles',
    'materiales',
    'semoviente'
);
    DROP TYPE public.tipo;
       public          postgres    false            ?            1259    17919    bien    TABLE     =  CREATE TABLE public.bien (
    bien_cod character(7) NOT NULL,
    bien_des character varying(90) DEFAULT NULL::character varying,
    bien_catalogo character varying(20) DEFAULT NULL::character varying,
    bien_fecha_ingreso date,
    bien_precio numeric(12,2) DEFAULT NULL::numeric,
    bien_divisa character varying(2) DEFAULT NULL::character varying,
    bien_depreciacion numeric(12,2) DEFAULT NULL::numeric,
    bien_estado boolean,
    bien_fecha_desactivacion date,
    bien_fecha_reactivacion date,
    bien_color_cod integer,
    bien_serial character varying(20) DEFAULT NULL::character varying,
    bien_clasificacion_cod character(2) NOT NULL,
    bien_link_bien character(7) DEFAULT NULL::bpchar,
    bien_mod_cod integer,
    bien_sexo character varying(1) DEFAULT NULL::character varying,
    bien_peso numeric(6,2) DEFAULT NULL::numeric,
    bien_anio numeric(4,0) DEFAULT NULL::numeric,
    bien_placa character varying(6) DEFAULT NULL::character varying,
    bien_terreno character varying(120) DEFAULT NULL::character varying,
    ifcomponente boolean NOT NULL
);
    DROP TABLE public.bien;
       public         heap    postgres    false            ?            1259    17936    cargos    TABLE     i   CREATE TABLE public.cargos (
    car_cod integer NOT NULL,
    car_des character varying(90) NOT NULL
);
    DROP TABLE public.cargos;
       public         heap    postgres    false            ?            1259    17934    cargos_car_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.cargos_car_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.cargos_car_cod_seq;
       public          postgres    false    204            Y           0    0    cargos_car_cod_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.cargos_car_cod_seq OWNED BY public.cargos.car_cod;
          public          postgres    false    203            ?            1259    17940 	   categoria    TABLE     ?   CREATE TABLE public.categoria (
    cat_cod character(2) NOT NULL,
    cat_des character varying(20) DEFAULT NULL::character varying
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            ?            1259    17944    clasificacion    TABLE     ?   CREATE TABLE public.clasificacion (
    cla_cod character(2) NOT NULL,
    cla_des character varying(30) DEFAULT NULL::character varying,
    cla_cat_cod character(2) DEFAULT NULL::bpchar
);
 !   DROP TABLE public.clasificacion;
       public         heap    postgres    false            ?            1259    17951    colores    TABLE     ?   CREATE TABLE public.colores (
    color_cod integer NOT NULL,
    color_des character varying(20) DEFAULT NULL::character varying
);
    DROP TABLE public.colores;
       public         heap    postgres    false            ?            1259    17949    colores_color_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.colores_color_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.colores_color_cod_seq;
       public          postgres    false    208            Z           0    0    colores_color_cod_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.colores_color_cod_seq OWNED BY public.colores.color_cod;
          public          postgres    false    207            ?            1259    17963    comprobantes    TABLE     )  CREATE TABLE public.comprobantes (
    com_cod character(10) NOT NULL,
    com_tipo character varying(1) DEFAULT NULL::character varying,
    com_bien_tipos public.tipo NOT NULL,
    com_estado boolean,
    com_dep_user integer NOT NULL,
    com_dep_ant integer,
    com_fecha_comprobante timestamp without time zone NOT NULL,
    com_num_factura character varying(11) DEFAULT NULL::character varying,
    com_justificacion character varying(11) DEFAULT NULL::character varying,
    com_observacion character varying(150) DEFAULT NULL::character varying,
    com_origen character varying(12) DEFAULT NULL::character varying,
    com_destino character varying(120) DEFAULT NULL::character varying,
    com_info_encargado character varying(120) NOT NULL,
    com_info_usuario character varying(120) NOT NULL
);
     DROP TABLE public.comprobantes;
       public         heap    postgres    false    659            ?            1259    17977    dependencia    TABLE       CREATE TABLE public.dependencia (
    dep_cod integer NOT NULL,
    dep_des character varying(100) NOT NULL,
    dep_nucleo_cod integer NOT NULL,
    dep_estado boolean NOT NULL,
    dep_ifprincipal boolean NOT NULL,
    dep_fecha_desactivacion date,
    dep_fecha_reactivacion date
);
    DROP TABLE public.dependencia;
       public         heap    postgres    false            ?            1259    17975    dependencia_dep_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.dependencia_dep_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.dependencia_dep_cod_seq;
       public          postgres    false    211            [           0    0    dependencia_dep_cod_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.dependencia_dep_cod_seq OWNED BY public.dependencia.dep_cod;
          public          postgres    false    210            ?            1259    17983    marcas    TABLE       CREATE TABLE public.marcas (
    mar_cod integer NOT NULL,
    mar_des character varying(30) DEFAULT NULL::character varying,
    mar_categoria_cod character(2) DEFAULT NULL::bpchar,
    mar_estado boolean,
    mar_fecha_desactivacion date,
    mar_fecha_reactivacion date
);
    DROP TABLE public.marcas;
       public         heap    postgres    false            ?            1259    17981    marcas_mar_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.marcas_mar_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.marcas_mar_cod_seq;
       public          postgres    false    213            \           0    0    marcas_mar_cod_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.marcas_mar_cod_seq OWNED BY public.marcas.mar_cod;
          public          postgres    false    212            ?            1259    17991    modelos    TABLE     ?   CREATE TABLE public.modelos (
    mod_cod integer NOT NULL,
    mod_des character varying(30) DEFAULT NULL::character varying,
    mod_marca_cod integer,
    mod_estado boolean,
    mod_fecha_desactivacion date,
    mod_fecha_reactivacion date
);
    DROP TABLE public.modelos;
       public         heap    postgres    false            ?            1259    17989    modelos_mod_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.modelos_mod_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.modelos_mod_cod_seq;
       public          postgres    false    215            ]           0    0    modelos_mod_cod_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.modelos_mod_cod_seq OWNED BY public.modelos.mod_cod;
          public          postgres    false    214            ?            1259    17996    movimientos    TABLE     ?   CREATE TABLE public.movimientos (
    mov_com_cod character(10) NOT NULL,
    mov_com_desincorporacion character(10) DEFAULT NULL::bpchar,
    mov_bien_cod character(7) NOT NULL
);
    DROP TABLE public.movimientos;
       public         heap    postgres    false            ?            1259    18002    nucleo    TABLE     ?  CREATE TABLE public.nucleo (
    nuc_cod integer NOT NULL,
    nuc_des character varying(60) NOT NULL,
    nuc_direccion character varying(150) DEFAULT NULL::character varying,
    nuc_codigo_postal character(4) NOT NULL,
    nuc_estado boolean NOT NULL,
    nuc_tipo_nucleo character varying(2) NOT NULL,
    nuc_nucleo_principal integer,
    nuc_fecha_desactivacion date,
    nuc_fecha_reactivacion date
);
    DROP TABLE public.nucleo;
       public         heap    postgres    false            ?            1259    18000    nucleo_nuc_cod_seq    SEQUENCE     ?   CREATE SEQUENCE public.nucleo_nuc_cod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.nucleo_nuc_cod_seq;
       public          postgres    false    218            ^           0    0    nucleo_nuc_cod_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.nucleo_nuc_cod_seq OWNED BY public.nucleo.nuc_cod;
          public          postgres    false    217            ?            1259    18007    personas    TABLE     ^  CREATE TABLE public.personas (
    per_cedula character(8) NOT NULL,
    per_nombre character varying(60) NOT NULL,
    per_apellido character varying(60) NOT NULL,
    per_estado boolean NOT NULL,
    per_car_cod integer NOT NULL,
    per_dep_cod integer NOT NULL,
    per_telefono character(11) DEFAULT NULL::bpchar,
    per_correo character varying(120) DEFAULT NULL::character varying,
    per_direccion character varying(60) DEFAULT NULL::character varying,
    per_desde date NOT NULL,
    per_hasta date,
    per_user_id integer,
    per_fecha_desactivacion date,
    per_fecha_reactivacion date
);
    DROP TABLE public.personas;
       public         heap    postgres    false            ?            1259    18015    roles    TABLE     )  CREATE TABLE public.roles (
    roles_id integer NOT NULL,
    roles_name character varying(30) NOT NULL,
    crear boolean NOT NULL,
    modificar boolean NOT NULL,
    consultar boolean NOT NULL,
    reporte boolean NOT NULL,
    eliminar boolean NOT NULL,
    admi_usuarios boolean NOT NULL
);
    DROP TABLE public.roles;
       public         heap    postgres    false            ?            1259    18013    roles_roles_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.roles_roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.roles_roles_id_seq;
       public          postgres    false    221            _           0    0    roles_roles_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.roles_roles_id_seq OWNED BY public.roles.roles_id;
          public          postgres    false    220            ?            1259    18021    usuarios    TABLE     e  CREATE TABLE public.usuarios (
    user_id integer NOT NULL,
    user_cedula character(8) NOT NULL,
    user_clave character varying(70) NOT NULL,
    user_nombre character varying(30) NOT NULL,
    user_estado boolean NOT NULL,
    user_role_id integer NOT NULL,
    user_pregunta1 character varying(100) DEFAULT NULL::character varying,
    user_respuesta1 character varying(50) DEFAULT NULL::character varying,
    user_pregunta2 character varying(100) DEFAULT NULL::character varying,
    user_respuesta2 character varying(50) DEFAULT NULL::character varying,
    user_photo character varying(60) NOT NULL
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            ?            1259    18019    usuarios_user_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.usuarios_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.usuarios_user_id_seq;
       public          postgres    false    223            `           0    0    usuarios_user_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.usuarios_user_id_seq OWNED BY public.usuarios.user_id;
          public          postgres    false    222            b           2604    17939    cargos car_cod    DEFAULT     p   ALTER TABLE ONLY public.cargos ALTER COLUMN car_cod SET DEFAULT nextval('public.cargos_car_cod_seq'::regclass);
 =   ALTER TABLE public.cargos ALTER COLUMN car_cod DROP DEFAULT;
       public          postgres    false    204    203    204            f           2604    17954    colores color_cod    DEFAULT     v   ALTER TABLE ONLY public.colores ALTER COLUMN color_cod SET DEFAULT nextval('public.colores_color_cod_seq'::regclass);
 @   ALTER TABLE public.colores ALTER COLUMN color_cod DROP DEFAULT;
       public          postgres    false    207    208    208            n           2604    17980    dependencia dep_cod    DEFAULT     z   ALTER TABLE ONLY public.dependencia ALTER COLUMN dep_cod SET DEFAULT nextval('public.dependencia_dep_cod_seq'::regclass);
 B   ALTER TABLE public.dependencia ALTER COLUMN dep_cod DROP DEFAULT;
       public          postgres    false    210    211    211            o           2604    17986    marcas mar_cod    DEFAULT     p   ALTER TABLE ONLY public.marcas ALTER COLUMN mar_cod SET DEFAULT nextval('public.marcas_mar_cod_seq'::regclass);
 =   ALTER TABLE public.marcas ALTER COLUMN mar_cod DROP DEFAULT;
       public          postgres    false    212    213    213            r           2604    17994    modelos mod_cod    DEFAULT     r   ALTER TABLE ONLY public.modelos ALTER COLUMN mod_cod SET DEFAULT nextval('public.modelos_mod_cod_seq'::regclass);
 >   ALTER TABLE public.modelos ALTER COLUMN mod_cod DROP DEFAULT;
       public          postgres    false    214    215    215            u           2604    18005    nucleo nuc_cod    DEFAULT     p   ALTER TABLE ONLY public.nucleo ALTER COLUMN nuc_cod SET DEFAULT nextval('public.nucleo_nuc_cod_seq'::regclass);
 =   ALTER TABLE public.nucleo ALTER COLUMN nuc_cod DROP DEFAULT;
       public          postgres    false    218    217    218            z           2604    18018    roles roles_id    DEFAULT     p   ALTER TABLE ONLY public.roles ALTER COLUMN roles_id SET DEFAULT nextval('public.roles_roles_id_seq'::regclass);
 =   ALTER TABLE public.roles ALTER COLUMN roles_id DROP DEFAULT;
       public          postgres    false    220    221    221            {           2604    18024    usuarios user_id    DEFAULT     t   ALTER TABLE ONLY public.usuarios ALTER COLUMN user_id SET DEFAULT nextval('public.usuarios_user_id_seq'::regclass);
 ?   ALTER TABLE public.usuarios ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    223    222    223            =          0    17919    bien 
   TABLE DATA           ^  COPY public.bien (bien_cod, bien_des, bien_catalogo, bien_fecha_ingreso, bien_precio, bien_divisa, bien_depreciacion, bien_estado, bien_fecha_desactivacion, bien_fecha_reactivacion, bien_color_cod, bien_serial, bien_clasificacion_cod, bien_link_bien, bien_mod_cod, bien_sexo, bien_peso, bien_anio, bien_placa, bien_terreno, ifcomponente) FROM stdin;
    public          postgres    false    202   ??       ?          0    17936    cargos 
   TABLE DATA           2   COPY public.cargos (car_cod, car_des) FROM stdin;
    public          postgres    false    204   ?       @          0    17940 	   categoria 
   TABLE DATA           5   COPY public.categoria (cat_cod, cat_des) FROM stdin;
    public          postgres    false    205   N?       A          0    17944    clasificacion 
   TABLE DATA           F   COPY public.clasificacion (cla_cod, cla_des, cla_cat_cod) FROM stdin;
    public          postgres    false    206   ??       C          0    17951    colores 
   TABLE DATA           7   COPY public.colores (color_cod, color_des) FROM stdin;
    public          postgres    false    208   ?       D          0    17963    comprobantes 
   TABLE DATA           ?   COPY public.comprobantes (com_cod, com_tipo, com_bien_tipos, com_estado, com_dep_user, com_dep_ant, com_fecha_comprobante, com_num_factura, com_justificacion, com_observacion, com_origen, com_destino, com_info_encargado, com_info_usuario) FROM stdin;
    public          postgres    false    209   i?       F          0    17977    dependencia 
   TABLE DATA           ?   COPY public.dependencia (dep_cod, dep_des, dep_nucleo_cod, dep_estado, dep_ifprincipal, dep_fecha_desactivacion, dep_fecha_reactivacion) FROM stdin;
    public          postgres    false    211   ??       H          0    17983    marcas 
   TABLE DATA           ?   COPY public.marcas (mar_cod, mar_des, mar_categoria_cod, mar_estado, mar_fecha_desactivacion, mar_fecha_reactivacion) FROM stdin;
    public          postgres    false    213   ??       J          0    17991    modelos 
   TABLE DATA              COPY public.modelos (mod_cod, mod_des, mod_marca_cod, mod_estado, mod_fecha_desactivacion, mod_fecha_reactivacion) FROM stdin;
    public          postgres    false    215   N?       K          0    17996    movimientos 
   TABLE DATA           Z   COPY public.movimientos (mov_com_cod, mov_com_desincorporacion, mov_bien_cod) FROM stdin;
    public          postgres    false    216   ??       M          0    18002    nucleo 
   TABLE DATA           ?   COPY public.nucleo (nuc_cod, nuc_des, nuc_direccion, nuc_codigo_postal, nuc_estado, nuc_tipo_nucleo, nuc_nucleo_principal, nuc_fecha_desactivacion, nuc_fecha_reactivacion) FROM stdin;
    public          postgres    false    218   ͔       N          0    18007    personas 
   TABLE DATA           ?   COPY public.personas (per_cedula, per_nombre, per_apellido, per_estado, per_car_cod, per_dep_cod, per_telefono, per_correo, per_direccion, per_desde, per_hasta, per_user_id, per_fecha_desactivacion, per_fecha_reactivacion) FROM stdin;
    public          postgres    false    219   <?       P          0    18015    roles 
   TABLE DATA           t   COPY public.roles (roles_id, roles_name, crear, modificar, consultar, reporte, eliminar, admi_usuarios) FROM stdin;
    public          postgres    false    221   ?       R          0    18021    usuarios 
   TABLE DATA           ?   COPY public.usuarios (user_id, user_cedula, user_clave, user_nombre, user_estado, user_role_id, user_pregunta1, user_respuesta1, user_pregunta2, user_respuesta2, user_photo) FROM stdin;
    public          postgres    false    223   n?       a           0    0    cargos_car_cod_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.cargos_car_cod_seq', 1, false);
          public          postgres    false    203            b           0    0    colores_color_cod_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.colores_color_cod_seq', 1, false);
          public          postgres    false    207            c           0    0    dependencia_dep_cod_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.dependencia_dep_cod_seq', 1, false);
          public          postgres    false    210            d           0    0    marcas_mar_cod_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.marcas_mar_cod_seq', 1, false);
          public          postgres    false    212            e           0    0    modelos_mod_cod_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.modelos_mod_cod_seq', 1, false);
          public          postgres    false    214            f           0    0    nucleo_nuc_cod_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.nucleo_nuc_cod_seq', 1, false);
          public          postgres    false    217            g           0    0    roles_roles_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.roles_roles_id_seq', 1, false);
          public          postgres    false    220            h           0    0    usuarios_user_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.usuarios_user_id_seq', 1, false);
          public          postgres    false    222            ?           2606    18042    bien bien_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.bien
    ADD CONSTRAINT bien_pkey PRIMARY KEY (bien_cod);
 8   ALTER TABLE ONLY public.bien DROP CONSTRAINT bien_pkey;
       public            postgres    false    202            ?           2606    18044    cargos cargos_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (car_cod);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
       public            postgres    false    204            ?           2606    18046    categoria categoria_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (cat_cod);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    205            ?           2606    18049     clasificacion clasificacion_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.clasificacion
    ADD CONSTRAINT clasificacion_pkey PRIMARY KEY (cla_cod);
 J   ALTER TABLE ONLY public.clasificacion DROP CONSTRAINT clasificacion_pkey;
       public            postgres    false    206            ?           2606    18051    colores colores_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.colores
    ADD CONSTRAINT colores_pkey PRIMARY KEY (color_cod);
 >   ALTER TABLE ONLY public.colores DROP CONSTRAINT colores_pkey;
       public            postgres    false    208            ?           2606    18055    comprobantes comprobantes_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.comprobantes
    ADD CONSTRAINT comprobantes_pkey PRIMARY KEY (com_cod);
 H   ALTER TABLE ONLY public.comprobantes DROP CONSTRAINT comprobantes_pkey;
       public            postgres    false    209            ?           2606    18058    dependencia dependencia_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.dependencia
    ADD CONSTRAINT dependencia_pkey PRIMARY KEY (dep_cod);
 F   ALTER TABLE ONLY public.dependencia DROP CONSTRAINT dependencia_pkey;
       public            postgres    false    211            ?           2606    18061    marcas marcas_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.marcas
    ADD CONSTRAINT marcas_pkey PRIMARY KEY (mar_cod);
 <   ALTER TABLE ONLY public.marcas DROP CONSTRAINT marcas_pkey;
       public            postgres    false    213            ?           2606    18064    modelos modelos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.modelos
    ADD CONSTRAINT modelos_pkey PRIMARY KEY (mod_cod);
 >   ALTER TABLE ONLY public.modelos DROP CONSTRAINT modelos_pkey;
       public            postgres    false    215            ?           2606    18070    nucleo nucleo_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.nucleo
    ADD CONSTRAINT nucleo_pkey PRIMARY KEY (nuc_cod);
 <   ALTER TABLE ONLY public.nucleo DROP CONSTRAINT nucleo_pkey;
       public            postgres    false    218            ?           2606    18078 !   personas personas_per_user_id_key 
   CONSTRAINT     c   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_per_user_id_key UNIQUE (per_user_id);
 K   ALTER TABLE ONLY public.personas DROP CONSTRAINT personas_per_user_id_key;
       public            postgres    false    219            ?           2606    18076    personas personas_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (per_cedula);
 @   ALTER TABLE ONLY public.personas DROP CONSTRAINT personas_pkey;
       public            postgres    false    219            ?           2606    18080    roles roles_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (roles_id);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public            postgres    false    221            ?           2606    18083    usuarios usuarios_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (user_id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    223            ?           1259    18038    bien_clasificacion_cod    INDEX     Y   CREATE INDEX bien_clasificacion_cod ON public.bien USING btree (bien_clasificacion_cod);
 *   DROP INDEX public.bien_clasificacion_cod;
       public            postgres    false    202            ?           1259    18040    bien_color_cod    INDEX     I   CREATE INDEX bien_color_cod ON public.bien USING btree (bien_color_cod);
 "   DROP INDEX public.bien_color_cod;
       public            postgres    false    202            ?           1259    18039    bien_mod_cod    INDEX     E   CREATE INDEX bien_mod_cod ON public.bien USING btree (bien_mod_cod);
     DROP INDEX public.bien_mod_cod;
       public            postgres    false    202            ?           1259    18047    cla_cat_cod    INDEX     L   CREATE INDEX cla_cat_cod ON public.clasificacion USING btree (cla_cat_cod);
    DROP INDEX public.cla_cat_cod;
       public            postgres    false    206            ?           1259    18053    com_dep_ant    INDEX     K   CREATE INDEX com_dep_ant ON public.comprobantes USING btree (com_dep_ant);
    DROP INDEX public.com_dep_ant;
       public            postgres    false    209            ?           1259    18052    com_dep_user    INDEX     M   CREATE INDEX com_dep_user ON public.comprobantes USING btree (com_dep_user);
     DROP INDEX public.com_dep_user;
       public            postgres    false    209            ?           1259    18056    dep_nucleo_cod    INDEX     P   CREATE INDEX dep_nucleo_cod ON public.dependencia USING btree (dep_nucleo_cod);
 "   DROP INDEX public.dep_nucleo_cod;
       public            postgres    false    211            ?           1259    18059    mar_categoria_cod    INDEX     Q   CREATE INDEX mar_categoria_cod ON public.marcas USING btree (mar_categoria_cod);
 %   DROP INDEX public.mar_categoria_cod;
       public            postgres    false    213            ?           1259    18062    mod_marca_cod    INDEX     J   CREATE INDEX mod_marca_cod ON public.modelos USING btree (mod_marca_cod);
 !   DROP INDEX public.mod_marca_cod;
       public            postgres    false    215            ?           1259    18067    mov_bien_cod    INDEX     L   CREATE INDEX mov_bien_cod ON public.movimientos USING btree (mov_bien_cod);
     DROP INDEX public.mov_bien_cod;
       public            postgres    false    216            ?           1259    18066    mov_com_desincorporacion    INDEX     d   CREATE INDEX mov_com_desincorporacion ON public.movimientos USING btree (mov_com_desincorporacion);
 ,   DROP INDEX public.mov_com_desincorporacion;
       public            postgres    false    216            ?           1259    18065    mov_com_incorporacion    INDEX     T   CREATE INDEX mov_com_incorporacion ON public.movimientos USING btree (mov_com_cod);
 )   DROP INDEX public.mov_com_incorporacion;
       public            postgres    false    216            ?           1259    18068    nuc_nucleo_principal    INDEX     W   CREATE INDEX nuc_nucleo_principal ON public.nucleo USING btree (nuc_nucleo_principal);
 (   DROP INDEX public.nuc_nucleo_principal;
       public            postgres    false    218            ?           1259    18071    per_car_cod    INDEX     G   CREATE INDEX per_car_cod ON public.personas USING btree (per_car_cod);
    DROP INDEX public.per_car_cod;
       public            postgres    false    219            ?           1259    18072    per_dep_cod    INDEX     G   CREATE INDEX per_dep_cod ON public.personas USING btree (per_dep_cod);
    DROP INDEX public.per_dep_cod;
       public            postgres    false    219            ?           1259    18074    per_user_id_2    INDEX     I   CREATE INDEX per_user_id_2 ON public.personas USING btree (per_user_id);
 !   DROP INDEX public.per_user_id_2;
       public            postgres    false    219            ?           1259    18073    per_user_role    INDEX     I   CREATE INDEX per_user_role ON public.personas USING btree (per_user_id);
 !   DROP INDEX public.per_user_role;
       public            postgres    false    219            ?           1259    18081    user_role_id    INDEX     I   CREATE INDEX user_role_id ON public.usuarios USING btree (user_role_id);
     DROP INDEX public.user_role_id;
       public            postgres    false    223            ?           2606    18094    bien bien_cla    FK CONSTRAINT     ?   ALTER TABLE ONLY public.bien
    ADD CONSTRAINT bien_cla FOREIGN KEY (bien_clasificacion_cod) REFERENCES public.clasificacion(cla_cod) ON UPDATE CASCADE;
 7   ALTER TABLE ONLY public.bien DROP CONSTRAINT bien_cla;
       public          postgres    false    206    202    2955            ?           2606    18084    bien bien_cor    FK CONSTRAINT     ?   ALTER TABLE ONLY public.bien
    ADD CONSTRAINT bien_cor FOREIGN KEY (bien_color_cod) REFERENCES public.colores(color_cod) ON UPDATE CASCADE;
 7   ALTER TABLE ONLY public.bien DROP CONSTRAINT bien_cor;
       public          postgres    false    202    2957    208            ?           2606    18089    bien bien_mod    FK CONSTRAINT     ?   ALTER TABLE ONLY public.bien
    ADD CONSTRAINT bien_mod FOREIGN KEY (bien_mod_cod) REFERENCES public.modelos(mod_cod) ON UPDATE CASCADE;
 7   ALTER TABLE ONLY public.bien DROP CONSTRAINT bien_mod;
       public          postgres    false    2970    215    202            ?           2606    18099    clasificacion cla_cat    FK CONSTRAINT     ?   ALTER TABLE ONLY public.clasificacion
    ADD CONSTRAINT cla_cat FOREIGN KEY (cla_cat_cod) REFERENCES public.categoria(cat_cod) ON UPDATE CASCADE;
 ?   ALTER TABLE ONLY public.clasificacion DROP CONSTRAINT cla_cat;
       public          postgres    false    205    206    2952            ?           2606    18104    comprobantes com_dep_ant    FK CONSTRAINT     ?   ALTER TABLE ONLY public.comprobantes
    ADD CONSTRAINT com_dep_ant FOREIGN KEY (com_dep_ant) REFERENCES public.dependencia(dep_cod) ON UPDATE CASCADE ON DELETE CASCADE;
 B   ALTER TABLE ONLY public.comprobantes DROP CONSTRAINT com_dep_ant;
       public          postgres    false    211    2964    209            ?           2606    18109    comprobantes com_dep_user    FK CONSTRAINT     ?   ALTER TABLE ONLY public.comprobantes
    ADD CONSTRAINT com_dep_user FOREIGN KEY (com_dep_user) REFERENCES public.dependencia(dep_cod) ON UPDATE CASCADE ON DELETE CASCADE;
 C   ALTER TABLE ONLY public.comprobantes DROP CONSTRAINT com_dep_user;
       public          postgres    false    211    209    2964            ?           2606    18114    dependencia dep_nuc    FK CONSTRAINT     ?   ALTER TABLE ONLY public.dependencia
    ADD CONSTRAINT dep_nuc FOREIGN KEY (dep_nucleo_cod) REFERENCES public.nucleo(nuc_cod) ON UPDATE CASCADE;
 =   ALTER TABLE ONLY public.dependencia DROP CONSTRAINT dep_nuc;
       public          postgres    false    2976    218    211            ?           2606    18119    marcas mar_cat    FK CONSTRAINT     ?   ALTER TABLE ONLY public.marcas
    ADD CONSTRAINT mar_cat FOREIGN KEY (mar_categoria_cod) REFERENCES public.categoria(cat_cod) ON UPDATE CASCADE;
 8   ALTER TABLE ONLY public.marcas DROP CONSTRAINT mar_cat;
       public          postgres    false    213    2952    205            ?           2606    18124    modelos mod_mar    FK CONSTRAINT     ?   ALTER TABLE ONLY public.modelos
    ADD CONSTRAINT mod_mar FOREIGN KEY (mod_marca_cod) REFERENCES public.marcas(mar_cod) ON UPDATE CASCADE;
 9   ALTER TABLE ONLY public.modelos DROP CONSTRAINT mod_mar;
       public          postgres    false    215    213    2967            ?           2606    18129    movimientos movimientos_ibfk_1    FK CONSTRAINT     ?   ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimientos_ibfk_1 FOREIGN KEY (mov_com_cod) REFERENCES public.comprobantes(com_cod) ON UPDATE CASCADE;
 H   ALTER TABLE ONLY public.movimientos DROP CONSTRAINT movimientos_ibfk_1;
       public          postgres    false    216    209    2961            ?           2606    18134    movimientos movimientos_ibfk_3    FK CONSTRAINT     ?   ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimientos_ibfk_3 FOREIGN KEY (mov_com_desincorporacion) REFERENCES public.comprobantes(com_cod) ON UPDATE CASCADE;
 H   ALTER TABLE ONLY public.movimientos DROP CONSTRAINT movimientos_ibfk_3;
       public          postgres    false    216    209    2961            ?           2606    18139    movimientos movimientos_ibfk_4    FK CONSTRAINT     ?   ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimientos_ibfk_4 FOREIGN KEY (mov_bien_cod) REFERENCES public.bien(bien_cod) ON UPDATE CASCADE;
 H   ALTER TABLE ONLY public.movimientos DROP CONSTRAINT movimientos_ibfk_4;
       public          postgres    false    216    2948    202            ?           2606    18144    nucleo nuc_principal    FK CONSTRAINT     ?   ALTER TABLE ONLY public.nucleo
    ADD CONSTRAINT nuc_principal FOREIGN KEY (nuc_nucleo_principal) REFERENCES public.nucleo(nuc_cod) ON UPDATE CASCADE;
 >   ALTER TABLE ONLY public.nucleo DROP CONSTRAINT nuc_principal;
       public          postgres    false    218    2976    218            ?           2606    18149    personas per_car    FK CONSTRAINT     ?   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT per_car FOREIGN KEY (per_car_cod) REFERENCES public.cargos(car_cod) ON UPDATE CASCADE;
 :   ALTER TABLE ONLY public.personas DROP CONSTRAINT per_car;
       public          postgres    false    2950    219    204            ?           2606    18154    personas per_dep    FK CONSTRAINT     ?   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT per_dep FOREIGN KEY (per_dep_cod) REFERENCES public.dependencia(dep_cod) ON UPDATE CASCADE;
 :   ALTER TABLE ONLY public.personas DROP CONSTRAINT per_dep;
       public          postgres    false    211    219    2964            ?           2606    18159    personas per_user    FK CONSTRAINT     ?   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT per_user FOREIGN KEY (per_user_id) REFERENCES public.usuarios(user_id) ON UPDATE CASCADE ON DELETE CASCADE;
 ;   ALTER TABLE ONLY public.personas DROP CONSTRAINT per_user;
       public          postgres    false    2989    223    219            ?           2606    18164    usuarios user_role    FK CONSTRAINT     ?   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT user_role FOREIGN KEY (user_role_id) REFERENCES public.roles(roles_id) ON UPDATE CASCADE;
 <   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT user_role;
       public          postgres    false    221    2986    223            =      x?????? ? ?      ?   $   x?3?t?KN,JOL??H??2?t?-?I??b???? ??	A      @   [   x?5??	? F᳙?	?C????h?S??????^Y?,/t??t5??T'?mb?BQP??SX?[?;??ޤ?1?H1????????^??      A   9   x?30?stv?t
?20?t??qt?r?t??22?t?v?Wp	?	??qqq %?      C   W   x??K
?0???F??-??30E??ϡ?BB?c???R????>rS?(????1q???????+4mn-D?E??>????      D      x?????? ? ?      F   _   x?3?tqp
q?u??WpqUp?t?sV?st???s?q?4?,?? ?2?vuɀ?:??::????Ac??????6Eq? E?J      H   I   x?3??q????t??,???".#?`G??P?wdAc?0GgGN?`??	'P?????)????kP???`? ??      J   R   x?MȻ?0??y
&@ʇ?C??2I?1?_PEHW]??V???_?=?U.??N(?-:???8:C??i?????c?LD/?P      K      x?????? ? ?      M   _   x??A
?0?uz?0,???I?i?f?cx??U???????O5?[A?? ѐ????????b?c??%?????K???A??????RAe      N   ?   x?m?Aj?0еr
C??`k?Գ??8??c??̢?1z?xQB)|?$??4Yj!??H??=???7@?d??hm;ɋTy?????
??4??h??3?f?9?7g^8$?1=?? &????B??7??????}??8m???<?Rv/*????l??????l?Rl???N_?d-?4پ=?s,?w?ikl`?Ch???v??0??J      P   F   x?3???+?,IL??L? ?\F??ř?%?y%?`??1?cJnf??i\&????E
?2%\1z\\\ :?      R   ?   x?m?1S?0????Wt`?? Ŏ?(	Q??\b??JA??z^???}?????&?f???.?^w?`/I|S?v)??;??{ԕ-w?ձ'?_??p[?? ?C???? e????l?????T?Z??? ??Iͯ??e,??TσjχF???RV+j??tl?Y̮2~+r:?oy?&?aJˤڨ1k?N?n;?tSMX?g?k:??(KC???????qQ ????_ͫe?7??\?     