-- NovaGym Database Seeder Script (seed_data.sql)
-- Diseñado para importación directa en phpMyAdmin (Laragon)
-- Respeta relaciones de clave foránea e inserción temporal distribuida

-- Deshabilitar temporalmente la verificación de llaves foráneas para evitar conflictos en reinicios
SET FOREIGN_KEY_CHECKS = 0;

-- Limpiar tablas para evitar registros duplicados
TRUNCATE TABLE `routines`;
TRUNCATE TABLE `clients`;
TRUNCATE TABLE `users`;

-- Habilitar nuevamente la verificación
SET FOREIGN_KEY_CHECKS = 1;

-- 1. INSERTAR ADMINISTRADOR PRINCIPAL
-- Contraseña por defecto: "password" (Hasheada con Bcrypt de Laravel)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Nova', 'albertogutierrezbedoya@gmail.com', NOW(), '$2y$12$R.Sj9tSNDfJ0/7R6.q4Jc.vXkK.q3e9aBwN8m7oFp3y7F.FpA8tLq', NULL, '2025-10-01 08:00:00', '2025-10-01 08:00:00');

-- 2. INSERTAR 18 CLIENTES DISTRIBUIDOS TEMPORALMENTE (Para un gráfico de barras perfecto de Octubre 2025 a Mayo 2026)
INSERT INTO `clients` (`id`, `user_id`, `name`, `email`, `phone`, `photo`, `status`, `created_at`, `updated_at`) VALUES
-- Octubre 2025 (Mes -7 de Mayo 2026)
(1, 1, 'Lucas Rivera', 'lucas.rivera@example.com', '+34 612 345 678', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200', 'active', '2025-10-10 10:14:32', '2025-10-10 10:14:32'),
(2, 1, 'Sofía Medina', 'sofia.medina@example.com', '+34 623 456 789', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=200', 'active', '2025-10-24 16:32:01', '2025-10-24 16:32:01'),

-- Noviembre 2025 (Mes -6)
(3, 1, 'Mateo Silva', 'mateo.silva@example.com', '+34 634 567 890', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200', 'active', '2025-11-05 11:24:15', '2025-11-05 11:24:15'),
(4, 1, 'Valentina Rojas', 'valentina.rojas@example.com', '+34 645 678 901', 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=200', 'active', '2025-11-18 15:40:00', '2025-11-18 15:40:00'),

-- Diciembre 2025 (Mes -5)
(5, 1, 'Alejandro Torres', 'alejandro.torres@example.com', '+34 656 789 012', NULL, 'active', '2025-12-03 09:12:44', '2025-12-03 09:12:44'),
(6, 1, 'Camila Castro', 'camila.castro@example.com', '+34 667 890 123', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=200', 'active', '2025-12-14 18:22:10', '2025-12-14 18:22:10'),
(7, 1, 'Santiago Delgado', 'santiago.delgado@example.com', '+34 678 901 234', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200', 'inactive', '2025-12-28 07:11:05', '2025-12-28 07:11:05'),

-- Enero 2026 (Mes -4)
(8, 1, 'Isabella Ortega', 'isabella.ortega@example.com', '+34 689 012 345', 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=200', 'active', '2026-01-08 14:15:32', '2026-01-08 14:15:32'),
(9, 1, 'Daniel Mendoza', 'daniel.mendoza@example.com', '+34 690 123 456', NULL, 'active', '2026-01-20 17:34:55', '2026-01-20 17:34:55'),

-- Febrero 2026 (Mes -3)
(10, 1, 'Mariana Guerrero', 'mariana.guerrero@example.com', '+34 601 234 567', 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&q=80&w=200', 'active', '2026-02-12 11:05:40', '2026-02-12 11:05:40'),
(11, 1, 'Sebastián Valenzuela', 'sebastian.val@example.com', '+34 611 223 344', NULL, 'inactive', '2026-02-25 15:18:22', '2026-02-25 15:18:22'),

-- Marzo 2026 (Mes -2)
(12, 1, 'Lucía Beltrán', 'lucia.beltran@example.com', '+34 622 334 455', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&q=80&w=200', 'active', '2026-03-04 09:22:15', '2026-03-04 09:22:15'),
(13, 1, 'Andrés Peña', 'andres.pena@example.com', '+34 633 445 566', NULL, 'active', '2026-03-15 16:12:00', '2026-03-15 16:12:00'),
(14, 1, 'Gabriela Fuentes', 'gabriela.fuentes@example.com', '+34 644 556 677', 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&q=80&w=200', 'active', '2026-03-27 10:45:00', '2026-03-27 10:45:00'),

-- Abril 2026 (Mes -1)
(15, 1, 'Joaquín Herrera', 'joaquin.herrera@example.com', '+34 655 667 788', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&q=80&w=200', 'active', '2026-04-11 08:33:40', '2026-04-11 08:33:40'),
(16, 1, 'Paula Vargas', 'paula.vargas@example.com', '+34 666 778 899', NULL, 'active', '2026-04-22 14:18:11', '2026-04-22 14:18:11'),

-- Mayo 2026 (Mes Actual)
(17, 1, 'Benjamín Navarro', 'benjamin.nav@example.com', '+34 677 889 900', 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=200', 'active', '2026-05-05 16:04:12', '2026-05-05 16:04:12'),
(18, 1, 'Emilia Santillán', 'emilia.s@example.com', '+34 688 990 011', 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?auto=format&fit=crop&q=80&w=200', 'active', '2026-05-18 11:55:00', '2026-05-18 11:55:00');

-- 3. INSERTAR 10 RUTINAS ASOCIADAS A LOS SOCIOS CREADOS (Con borrado en cascada configurado en clients)
INSERT INTO `routines` (`id`, `client_id`, `name`, `description`, `difficulty`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hipertrofia Funcional X', 'Enfoque en fuerza máxima y volumen muscular empleando patrones de movimiento compuestos y alta densidad de entrenamiento. Ideal para atletas avanzados.', 'advanced', '2025-10-15 08:00:00', '2025-10-15 08:00:00'),
(2, 2, 'Fuerza Básica 5x5', 'Rutina clásica de fuerza basada en ejercicios multiarticulares: Sentadilla, Press Banca, Peso Muerto, Press Militar y Remo con Barra.', 'beginner', '2025-10-28 09:30:00', '2025-10-28 09:30:00'),
(3, 3, 'Acondicionamiento Nova H.I.I.T', 'Circuito metabólico de alta intensidad para optimizar el consumo de oxígeno (VO2 máx) y acelerar la oxidación de lípidos.', 'intermediate', '2025-11-10 15:45:00', '2025-11-10 15:45:00'),
(4, 4, 'Powerbuilding Pro', 'Combinación perfecta de levantamientos de fuerza para powerlifting y ejercicios de aislamiento de culturismo para estética.', 'advanced', '2025-11-23 10:20:00', '2025-11-23 10:20:00'),
(5, 5, 'Movilidad y Core Start', 'Enfoque en mejorar los rangos de movimiento articular, flexibilidad dinámica y estabilización de la zona media.', 'beginner', '2025-12-08 17:00:00', '2025-12-08 17:00:00'),
(6, 6, 'Full Body Nova Athlete', 'Rutina cuerpo completo de tres días por semana, optimizada para deportistas que buscan rendimiento y desarrollo atlético equilibrado.', 'intermediate', '2025-12-19 14:15:00', '2025-12-19 14:15:00'),
(7, 8, 'Empuje / Tirón / Pierna (PPL)', 'División clásica para hipertrofia, distribuyendo los días en patrones de empuje, tirón y tren inferior para máxima recuperación.', 'intermediate', '2026-01-12 08:00:00', '2026-01-12 08:00:00'),
(8, 10, 'Acondicionamiento Cardiovascular GPP', 'Preparación física general enfocada en resistencia cardiovascular mediante remo, bicicleta estática y kettlebell swings.', 'beginner', '2026-02-15 09:00:00', '2026-02-15 09:00:00'),
(9, 12, 'Fuerza Explosiva y Pliometría', 'Rutina avanzada para el desarrollo de potencia vertical, aceleración y transferencia de fuerza mediante saltos y lanzamientos.', 'advanced', '2026-03-09 11:30:00', '2026-03-09 11:30:00'),
(10, 15, 'Rutina Definición Estética', 'Volumen de trabajo medio-alto con descansos cortos e inclusión de superseries para optimizar la definición muscular manteniendo la fuerza.', 'intermediate', '2026-04-16 16:00:00', '2026-04-16 16:00:00');
