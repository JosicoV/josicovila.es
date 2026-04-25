<!DOCTYPE html>
<?php
// Habilitar temporalmente la visualización de errores para depuración en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vite-helpers.php';
$viteAssets = vite('src/main.js'); // Llama a la función vite() pasando tu punto de entrada JS
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" 
      type="image/png" 
      href="/media/img/logo.png">
    <title>Mundo 3D de Josico Vila - Explora el Pueblo de los Dragones</title>
    <meta name="description" content="Sumérgete en el Mundo 3D de Josico Vila. Explora el Pueblo de los Dragones, viaja por portales a islas de música y relatos, y elige tu avatar para una aventura interactiva.">
    <style>
      body {
            margin: 0;
            overflow: hidden;
            background-color: black; /* <-- Forzar fondo negro */
        }
        canvas { display: block; }
      #container { z-index: 2000000000; position: fixed; bottom: 20px; left: 30px; width: 220px; height: 200px; display: none}
      #info { position: relative; top: 10px; left: 10px; color: black; font-size: 15px; display: flex; flex-direction: row; align-items: center; justify-content: space-between; border: 1px black solid; border-radius: 20px; background-color: rgba(255,255,255, 0.5); padding: 20px;}
      #players { color: black; font-size: 30px; font-weight: bold; }
      #time-arc-container{
        top: 10px;
        left: 50%;
        position: absolute;
        transform: translateX(-50%);
        width: 150px;
        height: 75px;
        z-index: 10;
        border: 1px solid black;
        border-radius: 20px;
        background: url('/media/img/ui/cottage.png') no-repeat center center;
        background-size: cover;
      }
      #time-arc-icon {
        position: absolute;
        width: 30px;
        height: 30px;
      }
      /* Estilos Barra de Progreso en Botones */
      
      .progress-container {
          position: absolute;
          top: 0; left: 0;
          width: 100%; height: 100%;
          background-color: #555; /* Color de fondo de la barra */
          display: flex; /* Para centrar el texto */
          align-items: center;
          justify-content: center;
          border-radius: inherit; /* Hereda el borde redondeado del botón */
      }
      .progress-bar {
          position: absolute;
          top: 0; left: 0;
          height: 100%; width: 0%; /* Empieza en 0% */
          background-color: #4CAF50; /* Color de la barra de progreso */
          transition: width 0.1s linear; /* Transición suave */
          border-radius: inherit;
          z-index: 0; /* Asegura que la barra esté detrás del texto */
      }
      /* Estilos Advertencia Múltiples Conexiones */
      #multiple-connections-warning {
            display: none; /* Oculto por defecto, JS lo mostrará */
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0; /* Ocupar toda la pantalla */
            background-color: rgba(0, 0, 0, 0.85); /* Fondo oscuro semitransparente */
            color: #ffcc00; /* Color de texto */
            z-index: -1; /* <<-- INICIALMENTE DETRÁS DE TODO */
            /* display: flex; <-- ELIMINAR DE AQUÍ, JS lo añadirá */
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: clamp(18px, 4vw, 28px); /* Tamaño de fuente adaptable */
            padding: 30px;
            box-sizing: border-box;
         }
        .progress-text {
            position: relative; /* Para que esté sobre la barra */
            z-index: 15000; /* Asegura que el texto esté sobre la barra */
            color: white; /* Asegura que el color contraste */
            font-size: 14px; /* O el tamaño que prefieras */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Sombra más definida para legibilidad */
            pointer-events: none; /* Evita que el texto bloquee clics al botón */
        }
        .button-text {
            display: none; /* Oculto por defecto */
            position: relative;
            z-index: 15000;
            color: white;
            pointer-events: none; /* Evita que el texto bloquee clics al botón */
            font-size: 18px;
        }
    

      /* === Intro aislada JosicoVila === */
      .wrapperPergamino {
        display: none !important;
      }
      .jvintro {
        position: fixed;
        inset: 0;
        z-index: 100000;
        overflow: hidden;
        font-family: "DM Sans", system-ui, sans-serif;
        color: #f4efe9;
        background:
          radial-gradient(ellipse 120% 70% at 50% 100%, rgba(10,24,45,.45) 0%, transparent 65%),
          radial-gradient(ellipse 45% 30% at 20% 75%, rgba(12,25,55,.35) 0%, transparent 60%),
          linear-gradient(180deg, #020510 0%, #03081a 45%, #02050f 100%);
      }
      .jvintro *, .jvintro *::before, .jvintro *::after { box-sizing: border-box; }
      .jvintro__stars,
      .jvintro__nebula {
        position: absolute; inset: 0; pointer-events: none;
      }
      .jvintro__stars {
        background:
          radial-gradient(1px 1px at 10% 20%, rgba(255,255,255,.70), transparent),
          radial-gradient(1px 1px at 30% 60%, rgba(255,255,255,.50), transparent),
          radial-gradient(1px 1px at 55% 15%, rgba(255,255,255,.60), transparent),
          radial-gradient(1px 1px at 70% 75%, rgba(255,255,255,.40), transparent),
          radial-gradient(1px 1px at 85% 35%, rgba(255,255,255,.70), transparent),
          radial-gradient(1px 1px at 20% 80%, rgba(255,255,255,.50), transparent),
          radial-gradient(1.6px 1.6px at 5% 50%, rgba(255,255,255,.8), transparent),
          radial-gradient(2px 2px at 92% 82%, rgba(236,177,72,.35), transparent),
          radial-gradient(2px 2px at 15% 40%, rgba(236,177,72,.28), transparent);
      }
      .jvintro__stars::after {
        content: '';
        position: absolute; inset: 0;
        background:
          radial-gradient(1.5px 1.5px at 25% 30%, rgba(255,240,220,.9), transparent),
          radial-gradient(1.5px 1.5px at 65% 55%, rgba(255,240,220,.9), transparent),
          radial-gradient(1.5px 1.5px at 80% 20%, rgba(255,240,220,.9), transparent);
        animation: jvintroTwinkle 4s ease-in-out infinite alternate;
      }
      .jvintro__nebula {
        background:
          radial-gradient(ellipse 80% 60% at 50% 50%, rgba(19,22,70,.48), transparent),
          radial-gradient(ellipse 40% 35% at 80% 20%, rgba(24,10,66,.30), transparent),
          radial-gradient(ellipse 50% 40% at 20% 80%, rgba(7,28,58,.22), transparent);
      }
      @keyframes jvintroTwinkle {
        0% { opacity: .2; }
        50% { opacity: 1; }
        100% { opacity: .4; }
      }
      .jvintro__screen {
        position: absolute !important;
        inset: 0 !important;
        top: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 24px;
        margin: 0 !important;
        translate: none !important;
        transform: none !important;
        visibility: visible !important;
        transition: opacity .45s ease, visibility .45s ease;
      }
      .jvintro__screen.is-hidden {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
      }
      .jvintro__welcome-inner {
        width: min(1300px, 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
      .jvintro__logo {
        margin-bottom: 18px;
      }
      .jvintro__logo img {
        width: 132px; height: auto; opacity: .92;
      }
      .jvintro__eyebrow,
      .jvintro__step,
      .jvintro__family {
        font-family: Georgia, serif;
        letter-spacing: .08em;
        color: #e0a12d;
      }
      .jvintro__eyebrow { font-size: 14px; margin-bottom: 18px; }
      .jvintro__title,
      .jvintro__avatar-title,
      .jvintro__name {
        font-family: Georgia, "Times New Roman", serif;
        font-weight: 900;
        line-height: .95;
        letter-spacing: -.03em;
        margin: 0;
      }
      .jvintro__title {
        font-size: clamp(64px, 8vw, 118px);
        max-width: 980px;
        margin-bottom: 30px;
      }
      .jvintro__gold { color: #f0b04a; font-style: italic; }
      .jvintro__desc {
        max-width: 760px;
        color: rgba(244,239,233,.58);
        font-size: 18px;
        line-height: 1.7;
        margin: 0 auto 38px;
      }
      .jvintro__controls-layout {
        width: min(1340px, 100%);
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        gap: 34px;
        align-items: stretch;
        margin-top: 12px;
      }
      .jvintro__panel {
        background: rgba(6,13,30,.74);
        border: 1px solid rgba(80,97,140,.18);
        box-shadow: inset 0 1px 0 rgba(255,255,255,.03);
      }
      .jvintro__panel--media {
        display: flex; align-items: center; justify-content: center; padding: 18px;
      }
      .jvintro__panel--media img { width: 100%; max-width: 620px; height: auto; display:block; }
      .jvintro__panel--text {
        padding: 44px 42px;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }
      .jvintro__panel--text h2 {
        margin: 0 0 28px;
        color: #e0a12d;
        font-family: Georgia, serif;
        font-size: clamp(32px, 3vw, 50px);
      }
      .jvintro__panel--text p {
        margin: 0;
        color: rgba(244,239,233,.72);
        font-size: 19px;
        line-height: 1.9;
        font-style: italic;
        font-family: Georgia, serif;
      }
      .jvintro__panel--text strong { color: #52d067; }
      .jvintro__actions {
        margin-top: 34px;
        display: flex; justify-content: center;
      }
      .jvintro__btn,
      .jvintro__enter {
        appearance: none;
        border: none;
        cursor: pointer;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        transition: transform .18s ease, opacity .18s ease, box-shadow .18s ease;
      }
      .jvintro__btn {
        background: #f0a114;
        color: #05070d;
        padding: 18px 44px;
        font-size: 17px;
        min-width: 270px;
      }
      .jvintro__btn:hover,
      .jvintro__enter:hover { transform: translateY(-2px); opacity: .92; }
      .jvintro__note {
        margin-top: 40px;
        color: rgba(244,239,233,.42);
        font-size: 15px;
      }
      .jvintro__note a { color: #e0a12d; text-decoration: none; }
      .jvintro__avatar-head {
        text-align: center;
        margin-bottom: 30px;
      }
      .jvintro__step { font-size: 14px; margin-bottom: 12px; }
      .jvintro__avatar-title {
        font-size: clamp(48px, 5vw, 78px);
      }
      .jvintro__avatar-wrap {
        width: min(1200px, 100%);
        display: grid;
        grid-template-columns: 74px 1fr 74px;
        align-items: center;
        gap: 26px;
      }
      .jvintro__arrow {
        width: 60px; height: 60px;
        border: 1px solid rgba(80,97,140,.22);
        background: rgba(6,13,30,.55);
        color: rgba(244,239,233,.85);
        font-size: 38px;
        line-height: 1;
        cursor: pointer;
        justify-self: center;
      }
      .jvintro__arrow:disabled { opacity: .3; cursor: default; }
      .jvintro__card {
        background: rgba(6,13,30,.74);
        border: 1px solid rgba(224,161,45,.72);
        min-height: 690px;
        display: grid;
        grid-template-columns: 40% 60%;
        overflow: hidden;
        touch-action: pan-y;
      }
      .jvintro__visual {
        display: flex; align-items: center; justify-content: center;
        padding: 40px 20px;
        position: relative;
      }
      .jvintro__visual::before {
        content: '';
        position: absolute;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(240,161,20,.24) 0%, rgba(240,161,20,.06) 45%, transparent 72%);
        filter: blur(8px);
      }
      .jvintro__visual img {
        position: relative;
        max-width: 86%;
        max-height: 360px;
        object-fit: contain;
        filter: drop-shadow(0 0 35px rgba(240,161,20,.24));
      }
      .jvintro__info {
        padding: 62px 52px 48px 10px;
        display: flex;
        flex-direction: column;
      }
      .jvintro__family { font-size: 16px; margin-bottom: 12px; }
      .jvintro__name { font-size: clamp(58px, 5vw, 90px); margin-bottom: 10px; }
      .jvintro__tagline {
        margin: 0 0 28px;
        color: rgba(244,239,233,.42);
        font-size: 20px;
        font-style: italic;
        font-family: Georgia, serif;
      }
      .jvintro__bio {
        color: rgba(244,239,233,.52);
        font-size: 17px;
        line-height: 1.9;
        max-width: 540px;
        margin-bottom: 34px;
      }
      .jvintro__stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 36px;
      }
      .jvintro__stat {
        background: rgba(2,7,20,.88);
        padding: 16px 18px 14px;
        border-left: 3px solid #f0a114;
      }
      .jvintro__stat small {
        display: block;
        color: rgba(244,239,233,.32);
        font-size: 12px;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 8px;
      }
      .jvintro__stat span {
        display: block;
        color: #f4efe9;
        font-size: 20px;
        font-weight: 700;
      }
      .jvintro__enter {
        background: #f0a114;
        color: #05070d;
        padding: 18px 28px;
        font-size: 16px;
        width: 100%;
      }
      .jvintro__load {
        margin-top: 14px;
      }
      .jvintro__loadbar {
        height: 8px;
        width: 100%;
        background: rgba(255,255,255,.12);
        border-radius: 999px;
        overflow: hidden;
        border: 1px solid rgba(95, 111, 155, 0.2);
      }
      .jvintro__loadfill {
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, #68d47c, #b7f2c5);
        transition: width .18s linear;
      }
      .jvintro__loadmeta {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        margin-top: 10px;
        font-size: 13px;
      }
      .jvintro__loadtext {
        color: rgba(244,239,233,.82);
      }
      .jvintro__loadhint {
        color: rgba(244,239,233,.42);
        text-align: right;
      }
      .jvintro__enter[disabled] {
        opacity: .6;
        cursor: not-allowed;
      }
      .jvintro__dots {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 24px;
      }
      .jvintro__dot {
        width: 28px; height: 4px;
        background: rgba(244,239,233,.18);
        border: none; cursor: pointer;
      }
      .jvintro__dot.is-active { background: #f0a114; width: 48px; }
      .jvintro__back {
        position: absolute;
        top: 26px; left: 26px;
        color: rgba(244,239,233,.5);
        background: transparent;
        border: none;
        font-size: 19px;
        cursor: pointer;
      }
      @media (max-width: 1180px) {
        .jvintro__controls-layout { grid-template-columns: 1fr; }
        .jvintro__card { grid-template-columns: 1fr; min-height: auto; }
        .jvintro__info { padding: 28px; }
      }
      @media (max-width: 768px) {
        .jvintro { overflow-y: auto; }
        .jvintro__screen { position: relative !important; inset: auto !important; min-height: 100vh; padding: 28px 16px 36px; }
        .jvintro__title { font-size: clamp(42px, 12vw, 68px); }
        .jvintro__desc { font-size: 16px; }
        .jvintro__panel--text { padding: 26px 22px; }
        .jvintro__panel--text p { font-size: 16px; }
        .jvintro__avatar-wrap { grid-template-columns: 1fr; gap: 16px; }
        .jvintro__arrow { display: none; }
        .jvintro__card { min-height: auto; }
        .jvintro__visual img { max-height: 220px; }
        .jvintro__name { font-size: 52px; }
        .jvintro__stats { grid-template-columns: 1fr 1fr; }
      }

      /* === Ajuste pantalla 1: hero como Mundo3D JosicoVila === */
      .jvintro__welcome-hero {
        width: min(1040px, 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
      }
      .jvintro__welcome-inner,
      .jvintro__controls-layout,
      .jvintro__panel,
      .jvintro__panel--media,
      .jvintro__panel--text {
        all: unset;
      }
      #jvintro-screen-welcome {
        justify-content: center !important;
      }
      #jvintro-screen-welcome .jvintro__logo {
        margin-bottom: 28px;
      }
      #jvintro-screen-welcome .jvintro__logo img {
        width: 98px;
        opacity: .96;
      }
      #jvintro-screen-welcome .jvintro__eyebrow {
        font-size: 15px;
        letter-spacing: .07em;
        margin-bottom: 22px;
        color: #d8992f;
      }
      #jvintro-screen-welcome .jvintro__title {
        font-size: clamp(72px, 7.2vw, 138px);
        line-height: .92;
        letter-spacing: -.04em;
        margin: 0 0 34px;
        text-transform: uppercase;
        max-width: 1000px;
        background: linear-gradient(180deg, #f6f1ea 0%, #efe5d9 42%, #e8c18a 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
      }
      #jvintro-screen-welcome .jvintro__gold {
        color: inherit;
        font-style: italic;
        -webkit-text-fill-color: inherit;
      }
      #jvintro-screen-welcome .jvintro__desc {
        max-width: 760px;
        color: rgba(244,239,233,.38);
        font-size: 21px;
        line-height: 1.75;
        margin: 0 auto 42px;
      }
      #jvintro-screen-welcome .jvintro__actions {
        margin-top: 0;
      }
      #jvintro-screen-welcome .jvintro__btn {
        min-width: 264px;
        padding: 19px 34px;
        font-size: 15px;
        background: #eea017;
        color: #05070d;
        box-shadow: 0 12px 30px rgba(238,160,23,.16);
      }
      #jvintro-screen-welcome .jvintro__note {
        margin-top: 44px;
        color: rgba(244,239,233,.28);
        font-size: 14px;
      }
      #jvintro-screen-welcome .jvintro__note strong { color: rgba(244,239,233,.45); }
      #jvintro-screen-welcome .jvintro__scrollhint {
        position: absolute;
        left: 50%;
        bottom: 28px;
        transform: translateX(-50%);
        width: 1px;
        height: 32px;
        overflow: hidden;
        opacity: .22;
      }
      #jvintro-screen-welcome .jvintro__scrollhint span {
        display: block;
        width: 1px;
        height: 100%;
        background: linear-gradient(to bottom, rgba(244,239,233,.55), transparent);
        animation: jvintroScroll 2s ease-in-out infinite;
      }
      @keyframes jvintroScroll {
        0%,100% { transform: scaleY(1); opacity: 1; }
        50% { transform: scaleY(.35); opacity: .4; }
      }
      @media (max-width: 1024px) {
        #jvintro-screen-welcome .jvintro__title {
          font-size: clamp(56px, 8.8vw, 96px);
        }
        #jvintro-screen-welcome .jvintro__desc {
          font-size: 18px;
          max-width: 680px;
        }
      }
      @media (max-width: 768px) {
        #jvintro-screen-welcome .jvintro__welcome-hero {
          padding: 24px 10px 54px;
        }
        #jvintro-screen-welcome .jvintro__logo {
          margin-bottom: 18px;
        }
        #jvintro-screen-welcome .jvintro__logo img {
          width: 86px;
        }
        #jvintro-screen-welcome .jvintro__eyebrow {
          font-size: 13px;
          margin-bottom: 18px;
        }
        #jvintro-screen-welcome .jvintro__title {
          font-size: clamp(38px, 11.5vw, 58px);
          margin-bottom: 24px;
        }
        #jvintro-screen-welcome .jvintro__desc {
          font-size: 16px;
          margin-bottom: 30px;
        }
        #jvintro-screen-welcome .jvintro__btn {
          min-width: 230px;
          font-size: 14px;
          padding: 16px 26px;
        }
        #jvintro-screen-welcome .jvintro__note {
          margin-top: 30px;
          font-size: 13px;
          line-height: 1.7;
        }
      }


      /* === Ajuste responsive pantalla 2: selector de avatar === */
      @media (max-width: 768px) {
        #jvintro-screen-avatar {
          justify-content: flex-start !important;
          align-items: stretch !important;
          padding-top: 18px !important;
          padding-bottom: 28px !important;
        }
        #jvintro-screen-avatar .jvintro__back {
          position: static;
          align-self: flex-start;
          margin: 0 0 14px;
          padding: 0;
          font-size: 17px;
          line-height: 1.2;
        }
        #jvintro-screen-avatar .jvintro__avatar-head {
          margin-bottom: 18px;
        }
        #jvintro-screen-avatar .jvintro__step {
          margin-bottom: 8px;
          font-size: 13px;
        }
        #jvintro-screen-avatar .jvintro__avatar-title {
          font-size: clamp(34px, 9vw, 56px);
          line-height: .95;
        }
        #jvintro-screen-avatar .jvintro__avatar-wrap {
          width: min(100%, 560px);
          margin: 0 auto;
          grid-template-columns: 1fr;
          gap: 12px;
        }
        #jvintro-screen-avatar .jvintro__card {
          width: 100%;
          min-height: auto;
          grid-template-columns: 1fr;
        }
        #jvintro-screen-avatar .jvintro__visual {
          padding: 18px 16px 4px;
          min-height: 180px;
        }
        #jvintro-screen-avatar .jvintro__visual::before {
          width: 220px;
          height: 220px;
        }
        #jvintro-screen-avatar .jvintro__visual img {
          max-height: 190px;
          max-width: 82%;
        }
        #jvintro-screen-avatar .jvintro__info {
          padding: 18px 18px 22px;
        }
        #jvintro-screen-avatar .jvintro__family {
          font-size: 14px;
          margin-bottom: 8px;
        }
        #jvintro-screen-avatar .jvintro__name {
          font-size: clamp(42px, 11vw, 58px);
          margin-bottom: 6px;
        }
        #jvintro-screen-avatar .jvintro__tagline {
          font-size: 16px;
          margin-bottom: 14px;
        }
        #jvintro-screen-avatar .jvintro__bio {
          font-size: 15px;
          line-height: 1.65;
          margin-bottom: 18px;
        }
        #jvintro-screen-avatar .jvintro__stats {
          gap: 10px;
          margin-bottom: 18px;
        }
        #jvintro-screen-avatar .jvintro__stat {
          padding: 13px 14px 12px;
        }
        #jvintro-screen-avatar .jvintro__stat small {
          font-size: 11px;
          margin-bottom: 6px;
        }
        #jvintro-screen-avatar .jvintro__stat span {
          font-size: 17px;
        }
        #jvintro-screen-avatar .jvintro__enter {
          padding: 15px 18px;
          font-size: 14px;
        }
        #jvintro-screen-avatar .jvintro__dots {
          margin-top: 16px;
          margin-bottom: 6px;
        }
        #jvintro-screen-avatar .jvintro__loadmeta {
          flex-direction: column;
          align-items: flex-start;
          gap: 4px;
        }
        #jvintro-screen-avatar .jvintro__loadhint {
          text-align: left;
        }
      }


      /* === Corrección de scroll vacío en móvil === */
      @media (max-width: 768px) {
        html, body {
          height: 100%;
          overflow: hidden !important;
        }
        .jvintro {
          overflow-y: auto !important;
          overflow-x: hidden !important;
          min-height: 100dvh;
          height: 100dvh;
        }
        .jvintro__screen {
          min-height: 100dvh !important;
          height: 100dvh !important;
          box-sizing: border-box;
        }

        /* Pantalla 1: centrada, sin espacio muerto debajo */
        #jvintro-screen-welcome {
          justify-content: center !important;
          align-items: center !important;
          padding-top: 18px !important;
          padding-bottom: 18px !important;
          overflow: hidden !important;
        }
        #jvintro-screen-welcome .jvintro__welcome-hero {
          min-height: auto !important;
          justify-content: center !important;
          margin: 0 auto !important;
        }
        #jvintro-screen-welcome .jvintro__scrollhint {
          bottom: 16px !important;
        }

        /* Pantalla 2: anclada arriba, sin hueco muerto encima */
        #jvintro-screen-avatar {
          justify-content: flex-start !important;
          align-items: stretch !important;
          padding-top: 12px !important;
          padding-bottom: 18px !important;
          overflow-y: auto !important;
          overflow-x: hidden !important;
        }
        #jvintro-screen-avatar .jvintro__back {
          margin-top: 0 !important;
        }
        #jvintro-screen-avatar .jvintro__avatar-head {
          margin-top: 0 !important;
        }
        #jvintro-screen-avatar .jvintro__avatar-wrap {
          margin-top: 0 !important;
        }
      }


      /* ══════════════════════════════════════════════════
         HUD — Pueblo de los Dragones | JosicoVila.es
         Design by JosicoVila · Single CSS source of truth
      ══════════════════════════════════════════════════ */

      /* ── Design tokens ── */
      :root {
        --jv-panel:    oklch(11% 0.025 255 / 0.82);
        --jv-panel-s:  oklch(14% 0.022 255 / 0.9);
        --jv-border:   oklch(28% 0.04  255 / 0.7);
        --jv-border-g: oklch(45% 0.1   68 / 0.5);
        --jv-text:     oklch(93% 0.006 80);
        --jv-muted:    oklch(52% 0.012 255);
        --jv-gold:     oklch(74% 0.15  68);
        --jv-gold-d:   oklch(58% 0.13  68);
        --jv-green:    oklch(70% 0.14  145);
        --jv-xp:       oklch(65% 0.16  150);
        --jv-rose:     oklch(68% 0.15  15);
        --jv-ff:       'DM Sans', system-ui, sans-serif;
        --jv-ff-d:     'Cinzel', 'Playfair Display', Georgia, serif;
        --jv-ff-m:     'DM Mono', monospace;
      }
      @keyframes jv-pulse   { 0%,100%{opacity:.4} 50%{opacity:1} }
      @keyframes jv-slideIn { from{opacity:0;transform:translateY(-12px)} to{opacity:1;transform:none} }
      @keyframes jv-slideUp { from{opacity:0;transform:translateY(12px)}  to{opacity:1;transform:none} }

      /* ── Hidden legacy elements ── */
      .extras,
      .wrapperPergamino,
      .marcoAvatar,
      #time-arc-container,
      #level-envelope,
      #send-btn,
      .listonhabilidades {
        display: none !important;
      }

      /* ── Logos: hidden by default ── */
      .logos { display: none !important; }
      .logos1, .logos2, .logos3, .logos4, .dedicatoria { display: none !important; }

      /* ── Portal content panels: game JS controls via style attribute ── */
      .musica:not([style*="block"]),
      .todoRelatos:not([style*="block"]),
      .todoLibros:not([style*="block"]) {
        display: none !important;
      }
      .musica, .todoRelatos, .todoLibros { z-index: 3000 !important; }

      .todoRelatos {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        padding: clamp(1rem, 2vw, 1.75rem) !important;
        box-sizing: border-box !important;
        background:
          radial-gradient(circle at top left, oklch(34% 0.12 18 / 0.24), transparent 34%),
          radial-gradient(circle at 82% 18%, oklch(58% 0.13 68 / 0.22), transparent 28%),
          linear-gradient(180deg, oklch(8% 0.03 250 / 0.96), oklch(11% 0.03 255 / 0.96)) !important;
        overflow: hidden !important;
      }
      .todoRelatos::before,
      .todoRelatos::after {
        content: "" !important;
        position: absolute !important;
        pointer-events: none !important;
        z-index: 0 !important;
      }
      .todoRelatos::before {
        top: -14rem !important;
        right: -7rem !important;
        width: 28rem !important;
        height: 28rem !important;
        border-radius: 50% !important;
        background: radial-gradient(circle, oklch(72% 0.14 68 / 0.16), transparent 68%) !important;
        filter: blur(6px) !important;
      }
      .todoRelatos::after {
        left: 6% !important;
        bottom: -10rem !important;
        width: 32rem !important;
        height: 20rem !important;
        border-radius: 999px !important;
        background: radial-gradient(circle, oklch(55% 0.12 28 / 0.18), transparent 70%) !important;
      }
      .todoRelatos .salirRelatos {
        top: 1.1rem !important;
        right: 1.2rem !important;
      }
      .todoRelatos .salirRelatos img {
        width: clamp(90px, 10vw, 150px) !important;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.35)) !important;
      }
      .todoRelatos .relatos {
        position: relative !important;
        z-index: 1 !important;
        width: 100% !important;
        height: 100% !important;
        top: 0 !important;
        padding: clamp(3.8rem, 8vh, 5.4rem) 0 0 !important;
        box-sizing: border-box !important;
      }
      .todoRelatos .wrapperCarrusel {
        align-items: stretch !important;
        justify-content: center !important;
        padding-inline: clamp(1rem, 2vw, 1.5rem) !important;
      }
      .todoRelatos .wrapperCarrusel > h1 {
        display: none !important;
      }
      .jv-stories-shell {
        display: grid !important;
        grid-template-columns: minmax(240px, 320px) minmax(0, 1fr) !important;
        gap: clamp(1.25rem, 2vw, 2rem) !important;
        width: 100% !important;
      }
      .jv-stories-header {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-self: stretch !important;
        min-height: 0 !important;
        padding: clamp(1.2rem, 2vw, 1.8rem) !important;
        color: var(--jv-text) !important;
        background: linear-gradient(180deg, oklch(12% 0.03 255 / 0.92), oklch(10% 0.02 255 / 0.78)) !important;
        border: 1px solid oklch(52% 0.12 68 / 0.28) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.03), 0 20px 50px rgba(0,0,0,.22) !important;
        backdrop-filter: blur(14px) !important;
      }
      .jv-stories-header__eyebrow {
        font: 700 0.72rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        color: var(--jv-gold) !important;
        margin-bottom: 0.95rem !important;
      }
      .jv-stories-header h1 {
        margin: 0 0 1rem !important;
        font: 900 clamp(2.2rem, 4vw, 4.25rem)/0.92 var(--jv-ff-d) !important;
        letter-spacing: -0.04em !important;
        color: #fff7eb !important;
        text-transform: none !important;
        position: static !important;
        transform: none !important;
      }
      .jv-stories-header p {
        margin: 0 !important;
        color: rgba(244,239,233,.72) !important;
        font: 400 1rem/1.8 var(--jv-ff) !important;
        max-width: 28rem !important;
      }
      .jv-stories-carousel {
        width: 100% !important;
        height: min(100%, 760px) !important;
        max-width: none !important;
        border: 1px solid oklch(45% 0.08 68 / 0.22) !important;
        border-radius: 28px !important;
        background: linear-gradient(180deg, oklch(12% 0.03 255 / 0.92), oklch(9% 0.02 255 / 0.9)) !important;
        box-shadow: 0 22px 60px rgba(0,0,0,.28), inset 0 1px 0 rgba(255,255,255,.04) !important;
        backdrop-filter: blur(18px) !important;
      }
      .todoRelatos .backdrop-blur {
        background-color: transparent !important;
      }
      .todoRelatos .grande {
        height: calc(100% - 7.5rem) !important;
      }
      .todoRelatos .item.jv-story-card {
        color: var(--jv-text) !important;
        height: 100% !important;
        padding: clamp(1.3rem, 2vw, 1.8rem) !important;
        gap: clamp(1rem, 2vw, 1.6rem) !important;
        align-items: stretch !important;
      }
      .jv-story-card__copy,
      .jv-story-card__media {
        min-width: 0 !important;
      }
      .jv-story-card__copy {
        gap: clamp(1rem, 2vw, 1.5rem) !important;
      }
      .jv-story-card__cover-wrap {
        width: min(44%, 220px) !important;
        aspect-ratio: 0.72 !important;
        flex-shrink: 0 !important;
        padding: 0.6rem !important;
        border-radius: 24px !important;
        background: linear-gradient(180deg, oklch(16% 0.03 255 / 0.86), oklch(10% 0.02 255 / 0.86)) !important;
        border: 1px solid oklch(52% 0.12 68 / 0.24) !important;
        box-shadow: 0 16px 32px rgba(0,0,0,.26) !important;
      }
      .jv-story-card__cover {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 18px !important;
      }
      .jv-story-card__meta {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        min-width: 0 !important;
      }
      .jv-story-card__eyebrow {
        color: var(--jv-gold) !important;
        font: 700 0.7rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        margin-bottom: 0.85rem !important;
      }
      .todoRelatos .info1 h2 {
        margin: 0 0 0.9rem !important;
        display: block !important;
        font: 900 clamp(1.8rem, 3vw, 3rem)/1 var(--jv-ff-d) !important;
        color: #fff8ec !important;
      }
      .todoRelatos .info1 p {
        margin: 0 !important;
        color: rgba(244,239,233,.72) !important;
        font: 400 1rem/1.8 var(--jv-ff) !important;
      }
      .jv-story-card__actions {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 0.85rem !important;
        margin-top: 1.35rem !important;
      }
      .jv-story-card__action {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 180px !important;
        padding: 0.9rem 1.2rem !important;
        border-radius: 999px !important;
        font: 800 0.83rem/1 var(--jv-ff) !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        text-decoration: none !important;
        cursor: pointer !important;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease !important;
      }
      .jv-story-card__action:hover {
        transform: translateY(-2px) !important;
      }
      .jv-story-card__action--online {
        color: #081015 !important;
        background: linear-gradient(135deg, #f2b14f, #ffcf78) !important;
        box-shadow: 0 16px 30px rgba(242,177,79,.22) !important;
      }
      .jv-story-card__action--pdf {
        color: #fff6ea !important;
        border: 1px solid oklch(58% 0.12 42 / 0.48) !important;
        background: linear-gradient(135deg, oklch(37% 0.12 28 / 0.88), oklch(31% 0.11 22 / 0.88)) !important;
        box-shadow: 0 14px 26px rgba(124,54,36,.18) !important;
      }
      .jv-story-card__media {
        border-left: 1px solid rgba(255,255,255,.08) !important;
        padding-left: clamp(1rem, 2vw, 1.6rem) !important;
      }
      .jv-story-card__video-shell {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0.9rem !important;
        padding: clamp(1rem, 2vw, 1.25rem) !important;
        border-radius: 24px !important;
        background: linear-gradient(180deg, oklch(11% 0.025 255 / 0.86), oklch(8% 0.02 255 / 0.88)) !important;
        border: 1px solid rgba(255,255,255,.06) !important;
      }
      .jv-story-card__video-label {
        color: rgba(244,239,233,.66) !important;
        font: 700 0.72rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.16em !important;
        text-transform: uppercase !important;
      }
      .todoRelatos .info2 video {
        width: 100% !important;
        height: 100% !important;
        min-height: 280px !important;
        object-fit: cover !important;
        border-radius: 18px !important;
        box-shadow: 0 18px 34px rgba(0,0,0,.25) !important;
      }
      .jv-stories-control {
        align-items: center !important;
        justify-content: space-between !important;
        padding: 0.8rem 1.4rem 1rem !important;
        gap: 1rem !important;
      }
      .jv-stories-control__hint {
        color: rgba(244,239,233,.56) !important;
        font: 400 0.94rem/1.5 var(--jv-ff) !important;
      }
      .todoRelatos .controlesRelatos {
        width: auto !important;
        padding: 0 !important;
        gap: 0.7rem !important;
      }
      .todoRelatos .controlesRelatos img {
        height: 42px !important;
        padding: 0.45rem !important;
        background: rgba(255,255,255,.05) !important;
        border: 1px solid rgba(255,255,255,.08) !important;
      }
      .todoRelatos .puntos {
        width: auto !important;
        padding: 0 !important;
        justify-content: flex-end !important;
        gap: 0.45rem !important;
      }
      .todoRelatos .punto {
        width: 14px !important;
        height: 14px !important;
        margin: 0 !important;
        box-shadow: none !important;
        background: rgba(255,255,255,.14) !important;
      }
      .todoRelatos .punto.activo {
        width: 36px !important;
        border-radius: 999px !important;
        background: linear-gradient(90deg, #f2b14f, #ffcf78) !important;
      }
      .todoRelatos .wrapperRelato {
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        padding: clamp(1rem, 3vw, 2rem) !important;
        box-sizing: border-box !important;
        background: rgba(4, 7, 16, 0.58) !important;
        backdrop-filter: blur(10px) !important;
      }
      .todoRelatos .relato.jv-story-detail {
        width: min(1080px, 100%) !important;
        max-width: 1080px !important;
        height: min(92vh, 900px) !important;
        background: radial-gradient(circle at top right, oklch(60% 0.13 68 / 0.16), transparent 28%), linear-gradient(180deg, rgba(255,250,243,.98), rgba(248,239,226,.96)) !important;
        border-radius: 30px !important;
        border: 1px solid rgba(168, 120, 58, 0.18) !important;
        box-shadow: 0 30px 70px rgba(0,0,0,.28) !important;
        padding: clamp(1.2rem, 2vw, 1.8rem) !important;
      }
      .jv-story-detail__control {
        gap: 1rem !important;
        align-items: stretch !important;
        border-radius: 24px !important;
        padding: 1rem !important;
        background: linear-gradient(135deg, rgba(17,23,39,.9), rgba(35,21,17,.78)) !important;
        box-shadow: 0 18px 36px rgba(30, 41, 59, 0.15) !important;
      }
      .jv-story-detail__audio {
        align-items: center !important;
        gap: 1rem !important;
      }
      .jv-story-detail__transport {
        width: 92px !important;
        min-width: 92px !important;
        align-items: center !important;
        justify-content: center !important;
      }
      .jv-story-detail__wave {
        flex: 1 !important;
        min-width: 0 !important;
      }
      .jv-story-detail__pdf {
        display: flex !important;
        align-items: center !important;
      }
      .jv-story-detail__pdf-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        white-space: nowrap !important;
        padding: 0.95rem 1.25rem !important;
        border-radius: 999px !important;
        background: linear-gradient(135deg, #9f3b24, #cf5a31) !important;
        color: #fff7ed !important;
        text-decoration: none !important;
        font: 800 0.82rem/1 var(--jv-ff) !important;
        letter-spacing: 0.09em !important;
        text-transform: uppercase !important;
        box-shadow: 0 16px 30px rgba(159,59,36,.22) !important;
      }
      .jv-story-detail__body {
        padding: 1.5rem 0.4rem 0.5rem !important;
      }
      .jv-story-detail__hero {
        max-width: 50rem !important;
        margin-bottom: 1.5rem !important;
      }
      .jv-story-detail__eyebrow {
        color: #b66a30 !important;
        font: 800 0.74rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        margin-bottom: 0.8rem !important;
      }
      .jv-story-detail h1 {
        margin: 0 0 0.75rem !important;
        color: #1f1720 !important;
        font: 900 clamp(2rem, 4vw, 3.6rem)/0.96 var(--jv-ff-d) !important;
      }
      .jv-story-detail__intro {
        margin: 0 !important;
        color: rgba(31,23,32,.72) !important;
        font: 400 1.05rem/1.8 var(--jv-ff) !important;
      }
      .jv-story-detail__prose {
        color: #2f2730 !important;
        font: 400 1.02rem/1.95 Georgia, serif !important;
      }
      .jv-story-detail__prose p {
        margin: 0 !important;
      }
      .jv-story-detail__signoff {
        margin: 2rem 0 0 !important;
        color: #8a552e !important;
        font: italic 500 1rem/1.9 Georgia, serif !important;
      }
      @media (max-width: 1100px) {
        .jv-stories-shell {
          grid-template-columns: 1fr !important;
        }
        .jv-stories-header {
          max-width: none !important;
        }
      }
      @media (max-width: 860px) {
        .todoRelatos {
          overflow-y: auto !important;
        }
        .todoRelatos .relatos {
          height: auto !important;
          min-height: 100% !important;
          padding-top: 4.8rem !important;
          padding-bottom: 1rem !important;
        }
        .todoRelatos .grande {
          height: auto !important;
        }
        .todoRelatos .item.jv-story-card {
          flex-direction: column !important;
          height: auto !important;
        }
        .jv-story-card__media {
          border-left: 0 !important;
          padding-left: 0 !important;
        }
        .jv-story-card__cover-wrap {
          width: min(52%, 220px) !important;
        }
        .jv-stories-control {
          flex-wrap: wrap !important;
        }
        .todoRelatos .wrapperRelato {
          align-items: flex-start !important;
          overflow-y: auto !important;
        }
        .todoRelatos .relato.jv-story-detail {
          height: auto !important;
          min-height: calc(100vh - 2rem) !important;
        }
        .jv-story-detail__audio {
          flex-wrap: wrap !important;
        }
        .jv-story-detail__transport {
          width: auto !important;
          min-width: 0 !important;
        }
        .jv-story-detail__pdf {
          width: 100% !important;
        }
        .jv-story-detail__pdf-link {
          width: 100% !important;
        }
      }
      @media (max-width: 600px) {
        .todoRelatos {
          padding: 0.8rem !important;
        }
        .todoRelatos .salirRelatos {
          top: auto !important;
          bottom: 0.6rem !important;
          right: 0.6rem !important;
        }
        .todoRelatos .relatos {
          padding-top: 1rem !important;
          padding-bottom: 5.2rem !important;
        }
        .jv-stories-header h1 {
          font-size: clamp(2rem, 10vw, 2.8rem) !important;
        }
        .jv-stories-header p,
        .todoRelatos .info1 p,
        .jv-story-detail__intro,
        .jv-story-detail__prose {
          font-size: 0.95rem !important;
        }
        .jv-story-card__actions,
        .todoRelatos .puntos {
          width: 100% !important;
        }
        .jv-story-card__action {
          width: 100% !important;
          min-width: 0 !important;
        }
        .todoRelatos .controlesRelatos,
        .todoRelatos .puntos {
          justify-content: center !important;
        }
      }

      .todoLibros {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        padding: clamp(1rem, 2vw, 1.75rem) !important;
        box-sizing: border-box !important;
        background:
          radial-gradient(circle at top right, oklch(58% 0.11 70 / 0.18), transparent 30%),
          radial-gradient(circle at 12% 80%, oklch(52% 0.09 40 / 0.16), transparent 30%),
          linear-gradient(180deg, oklch(10% 0.025 255 / 0.97), oklch(12% 0.03 35 / 0.95)) !important;
        overflow: hidden !important;
      }
      .todoLibros::before,
      .todoLibros::after {
        content: "" !important;
        position: absolute !important;
        pointer-events: none !important;
        z-index: 0 !important;
      }
      .todoLibros::before {
        top: -10rem !important;
        left: -4rem !important;
        width: 24rem !important;
        height: 24rem !important;
        border-radius: 50% !important;
        background: radial-gradient(circle, oklch(72% 0.13 75 / 0.14), transparent 70%) !important;
      }
      .todoLibros::after {
        right: 8% !important;
        bottom: -9rem !important;
        width: 30rem !important;
        height: 18rem !important;
        border-radius: 999px !important;
        background: radial-gradient(circle, oklch(42% 0.1 30 / 0.16), transparent 72%) !important;
      }
      .todoLibros .salirLibros {
        top: 1.1rem !important;
        right: 1.2rem !important;
      }
      .todoLibros .salirLibros img {
        width: clamp(90px, 10vw, 150px) !important;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.35)) !important;
      }
      .todoLibros .libros {
        position: relative !important;
        z-index: 1 !important;
        width: 100% !important;
        height: 100% !important;
        top: 0 !important;
        padding: clamp(3.8rem, 8vh, 5.4rem) 0 0 !important;
        box-sizing: border-box !important;
      }
      .todoLibros .wrapperCarrusel {
        align-items: stretch !important;
        justify-content: center !important;
        padding-inline: clamp(1rem, 2vw, 1.5rem) !important;
      }
      .todoLibros .wrapperCarrusel > h1 {
        display: none !important;
      }
      .jv-books-shell {
        display: grid !important;
        grid-template-columns: minmax(250px, 340px) minmax(0, 1fr) !important;
        gap: clamp(1.25rem, 2vw, 2rem) !important;
        width: 100% !important;
      }
      .jv-books-header {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-self: stretch !important;
        min-height: 0 !important;
        padding: clamp(1.2rem, 2vw, 1.85rem) !important;
        color: var(--jv-text) !important;
        background: linear-gradient(180deg, oklch(13% 0.03 255 / 0.9), oklch(14% 0.03 40 / 0.82)) !important;
        border: 1px solid oklch(55% 0.1 68 / 0.24) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.03), 0 20px 50px rgba(0,0,0,.24) !important;
        backdrop-filter: blur(14px) !important;
      }
      .jv-books-header__eyebrow {
        font: 700 0.72rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        color: #efbc68 !important;
        margin-bottom: 0.95rem !important;
      }
      .jv-books-header h1 {
        margin: 0 0 1rem !important;
        font: 900 clamp(2.2rem, 4vw, 4.3rem)/0.92 var(--jv-ff-d) !important;
        letter-spacing: -0.04em !important;
        color: #fff8ef !important;
        text-transform: none !important;
        position: static !important;
        transform: none !important;
      }
      .jv-books-header p {
        margin: 0 !important;
        color: rgba(244,239,233,.72) !important;
        font: 400 1rem/1.8 var(--jv-ff) !important;
        max-width: 30rem !important;
      }
      .jv-books-carousel {
        width: 100% !important;
        height: min(100%, 760px) !important;
        max-width: none !important;
        border: 1px solid oklch(45% 0.08 68 / 0.2) !important;
        border-radius: 30px !important;
        background:
          radial-gradient(circle at top center, rgba(255,255,255,.04), transparent 30%),
          linear-gradient(180deg, oklch(12% 0.03 255 / 0.92), oklch(13% 0.03 32 / 0.92)) !important;
        box-shadow: 0 24px 64px rgba(0,0,0,.3), inset 0 1px 0 rgba(255,255,255,.04) !important;
        backdrop-filter: blur(18px) !important;
      }
      .todoLibros .backdrop-blur {
        background-color: transparent !important;
      }
      .todoLibros .grandeLibros {
        height: calc(100% - 7.5rem) !important;
      }
      .todoLibros .itemLibros.jv-book-card {
        color: var(--jv-text) !important;
        height: 100% !important;
        padding: clamp(1.3rem, 2vw, 1.8rem) !important;
        gap: clamp(1rem, 2vw, 1.6rem) !important;
        align-items: stretch !important;
      }
      .jv-book-card__copy,
      .jv-book-card__media {
        min-width: 0 !important;
      }
      .jv-book-card__copy {
        gap: clamp(1rem, 2vw, 1.5rem) !important;
        padding: clamp(1rem, 2vw, 1.4rem) !important;
        border-radius: 28px !important;
        background-color: rgba(17, 12, 14, 0.38) !important;
        background-blend-mode: screen !important;
        border: 1px solid rgba(255,255,255,.06) !important;
      }
      .jv-book-card__cover-wrap {
        width: min(42%, 220px) !important;
        aspect-ratio: 0.68 !important;
        flex-shrink: 0 !important;
        padding: 0.7rem !important;
        border-radius: 24px !important;
        background: linear-gradient(180deg, rgba(19,15,18,.82), rgba(10,8,14,.88)) !important;
        border: 1px solid rgba(241,189,108,.22) !important;
        box-shadow: 0 18px 36px rgba(0,0,0,.3) !important;
      }
      .jv-book-card__cover {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 18px !important;
      }
      .jv-book-card__meta {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        min-width: 0 !important;
      }
      .jv-book-card__eyebrow {
        color: #efbc68 !important;
        font: 700 0.7rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        margin-bottom: 0.85rem !important;
      }
      .todoLibros .info1 h2 {
        margin: 0 0 0.9rem !important;
        display: block !important;
        font: 900 clamp(1.7rem, 2.9vw, 2.85rem)/1.02 var(--jv-ff-d) !important;
        color: #fff8ee !important;
      }
      .todoLibros .info1 p {
        margin: 0 !important;
        color: rgba(244,239,233,.74) !important;
        font: 400 1rem/1.8 var(--jv-ff) !important;
      }
      .jv-book-card__badge {
        display: inline-flex !important;
        align-items: center !important;
        width: fit-content !important;
        margin-top: 1.2rem !important;
        padding: 0.7rem 1rem !important;
        border-radius: 999px !important;
        background: linear-gradient(135deg, rgba(228,176,86,.18), rgba(153,79,36,.25)) !important;
        border: 1px solid rgba(239,188,104,.24) !important;
        color: #fff0d6 !important;
        font: 800 0.78rem/1 var(--jv-ff) !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
      }
      .jv-book-card__media {
        border-left: 1px solid rgba(255,255,255,.08) !important;
        padding-left: clamp(1rem, 2vw, 1.6rem) !important;
      }
      .jv-book-card__video-shell {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0.9rem !important;
        padding: clamp(1rem, 2vw, 1.25rem) !important;
        border-radius: 24px !important;
        background: linear-gradient(180deg, rgba(14,18,29,.88), rgba(28,16,12,.86)) !important;
        border: 1px solid rgba(255,255,255,.06) !important;
      }
      .jv-book-card__video-label {
        color: rgba(244,239,233,.66) !important;
        font: 700 0.72rem/1 var(--jv-ff-m) !important;
        letter-spacing: 0.16em !important;
        text-transform: uppercase !important;
      }
      .todoLibros .info2 .video {
        width: 100% !important;
        height: 100% !important;
        min-height: 320px !important;
        border: 0 !important;
        border-radius: 18px !important;
        box-shadow: 0 18px 34px rgba(0,0,0,.25) !important;
      }
      .jv-books-control {
        align-items: center !important;
        justify-content: space-between !important;
        padding: 0.8rem 1.4rem 1rem !important;
        gap: 1rem !important;
      }
      .jv-books-control__hint {
        color: rgba(244,239,233,.56) !important;
        font: 400 0.94rem/1.5 var(--jv-ff) !important;
      }
      .todoLibros .controlesLibros {
        width: auto !important;
        padding: 0 !important;
        gap: 0.7rem !important;
      }
      .todoLibros .controlesLibros img {
        height: 42px !important;
        padding: 0.45rem !important;
        background: rgba(255,255,255,.05) !important;
        border: 1px solid rgba(255,255,255,.08) !important;
      }
      .todoLibros .puntos {
        width: auto !important;
        padding: 0 !important;
        justify-content: flex-end !important;
        gap: 0.45rem !important;
      }
      .todoLibros .puntoLibros {
        width: 14px !important;
        height: 14px !important;
        margin: 0 !important;
        box-shadow: none !important;
        background: rgba(255,255,255,.14) !important;
      }
      .todoLibros .puntoLibros.activo {
        width: 36px !important;
        border-radius: 999px !important;
        background: linear-gradient(90deg, #efbc68, #ffd694) !important;
      }
      @media (max-width: 1100px) {
        .jv-books-shell {
          grid-template-columns: 1fr !important;
        }
        .jv-books-header {
          max-width: none !important;
        }
      }
      @media (max-width: 860px) {
        .todoLibros {
          overflow-y: auto !important;
        }
        .todoLibros .libros {
          height: auto !important;
          min-height: 100% !important;
          padding-top: 4.8rem !important;
          padding-bottom: 1rem !important;
        }
        .todoLibros .grandeLibros {
          height: auto !important;
        }
        .todoLibros .itemLibros.jv-book-card {
          flex-direction: column !important;
          height: auto !important;
        }
        .jv-book-card__media {
          border-left: 0 !important;
          padding-left: 0 !important;
        }
        .jv-book-card__cover-wrap {
          width: min(52%, 220px) !important;
        }
        .jv-books-control {
          flex-wrap: wrap !important;
        }
      }
      @media (max-width: 600px) {
        .todoLibros {
          padding: 0.8rem !important;
        }
        .todoLibros .salirLibros {
          top: auto !important;
          bottom: 0.6rem !important;
          right: 0.6rem !important;
        }
        .todoLibros .libros {
          padding-top: 1rem !important;
          padding-bottom: 5.2rem !important;
        }
        .jv-books-header h1 {
          font-size: clamp(2rem, 10vw, 2.8rem) !important;
        }
        .jv-books-header p,
        .todoLibros .info1 p {
          font-size: 0.95rem !important;
        }
        .todoLibros .controlesLibros,
        .todoLibros .puntos {
          justify-content: center !important;
        }
      }

      /* ══ PLAYER CARD (top-left) ══ */
      /* ══ PLAYER CARD (top-left) — matches handoff #player-card ══ */
      .jv-player-card {
        position: fixed !important;
        top: 1.5rem !important;
        left: 1.5rem !important;
        z-index: 2200 !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.9rem !important;
        padding: 0.8rem 1.1rem 0.8rem 0.8rem !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border-g) !important;
        backdrop-filter: blur(16px) !important;
        box-shadow: 0 0 20px oklch(65% 0.15 68 / 0.08) !important;
        min-width: 220px !important;
        animation: jv-slideIn 0.5s 0.1s ease both !important;
      }
      /* Avatar frame — matches handoff .avatar-frame */
      .jv-player-card__ring {
        position: relative !important;
        width: 52px !important;
        height: 52px !important;
        flex-shrink: 0 !important;
        border: 2px solid var(--jv-gold-d) !important;
        box-shadow: 0 0 8px oklch(58% 0.13 68 / 0.4) !important;
        background: oklch(8% 0.025 255) !important;
        overflow: visible !important;
      }
      .jv-player-card__avatar {
        width: 52px !important;
        height: 52px !important;
        object-fit: contain !important;
        display: block !important;
        background: transparent !important;
      }
      /* Level badge — matches handoff .level-badge */
      .jv-player-card__badge {
        position: absolute !important;
        bottom: -6px !important;
        right: -8px !important;
        background: var(--jv-gold) !important;
        color: oklch(7% 0.025 255) !important;
        font-family: var(--jv-ff-m) !important;
        font-size: 0.58rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.04em !important;
        padding: 1px 5px !important;
        line-height: 1.6 !important;
        white-space: nowrap !important;
        z-index: 1 !important;
      }
      /* Info column — matches handoff .player-info */
      .jv-player-card__meta {
        flex: 1 !important;
        min-width: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0.3rem !important;
      }
      .jv-player-card__hotkey,
      .jv-player-card__fullscreen { display: none !important; }
      /* Name — matches handoff .player-name */
      .jv-player-card__name {
        font-family: var(--jv-ff-d) !important;
        font-size: 0.95rem !important;
        letter-spacing: 0.03em !important;
        color: var(--jv-text) !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        line-height: 1.2 !important;
        margin-bottom: 0.1rem !important;
        background: none !important;
        -webkit-text-fill-color: unset !important;
      }
      /* XP label — matches handoff .xp-label */
      .jv-player-card__xp-label {
        font-family: var(--jv-ff-m) !important;
        font-size: 0.6rem !important;
        letter-spacing: 0.04em !important;
        display: flex !important;
        justify-content: space-between !important;
        color: var(--jv-muted) !important;
      }
      .jv-player-card__xp-label span:last-child { color: var(--jv-xp) !important; }
      /* XP track — matches handoff .xp-track / .xp-fill */
      .jv-player-card__xp-track {
        height: 4px !important;
        background: oklch(20% 0.02 255) !important;
        overflow: hidden !important;
        position: relative !important;
      }
      .jv-player-card__xp-fill {
        height: 100% !important;
        width: 0%;
        background: linear-gradient(90deg, var(--jv-xp), oklch(80% 0.18 155)) !important;
        transition: width 1s ease !important;
      }

      /* ══ MINIMAP ══ */
      .marcoMinimapa {
        display: block;
        position: fixed !important;
        left: 1.5rem !important;
        top: calc(1.5rem + 78px + 0.8rem) !important;
        z-index: 2199 !important;
        width: 220px !important;
        height: auto !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border-g) !important;
        backdrop-filter: blur(16px) !important;
        padding: 6px !important;
        overflow: hidden !important;
        box-shadow: 0 0 20px oklch(65% 0.15 68 / 0.06) !important;
        box-sizing: border-box !important;
      }
      .jv-minimap__label {
        font-family: var(--jv-ff-m) !important;
        font-size: 0.52rem !important;
        color: var(--jv-muted) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        margin-bottom: 0.3rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.35rem !important;
      }
      .jv-minimap__label::before {
        content: '' !important;
        display: inline-block !important;
        width: 5px !important;
        height: 5px !important;
        background: var(--jv-green) !important;
        border-radius: 50% !important;
        box-shadow: 0 0 5px var(--jv-green) !important;
        animation: jv-pulse 2s ease-in-out infinite !important;
      }
      .minimap {
        display: block !important;
        position: relative !important;
        top: auto !important;
        left: auto !important;
        width: 208px !important;
        height: 208px !important;
        max-width: 208px !important;
        max-height: 208px !important;
        transform: none !important;
        border: 1px solid oklch(28% 0.04 255 / 0.4) !important;
      }

      /* ══ WORLD INFO (top-right) ══ */
      #jv-world-info {
        position: fixed !important;
        top: 1.5rem !important;
        right: 1.5rem !important;
        z-index: 2200 !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.6rem !important;
        animation: jv-slideIn 0.5s 0.2s ease both !important;
      }
      #jv-btn-blog,
      #jv-time-chip {
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) saturate(1.4) !important;
      }
      #jv-btn-blog {
        width: 44px !important;
        height: 44px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--jv-muted) !important;
        text-decoration: none !important;
        transition: border-color 0.2s, color 0.2s !important;
      }
      #jv-btn-blog:hover {
        border-color: var(--jv-gold) !important;
        color: var(--jv-gold) !important;
      }
      #jv-btn-blog svg {
        width: 18px !important;
        height: 18px !important;
      }
      #jv-time-chip {
        padding: 0.5rem 0.9rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        color: var(--jv-text) !important;
        font-size: 0.78rem !important;
        font-weight: 500 !important;
      }
      .jv-time-sun {
        width: 20px !important;
        height: 20px !important;
        border-radius: 50% !important;
        background: radial-gradient(circle, var(--jv-gold), oklch(65% 0.18 68)) !important;
        box-shadow: 0 0 10px oklch(58% 0.13 68 / 0.5) !important;
        flex-shrink: 0 !important;
      }
      .jv-time-sun.is-moon {
        background: radial-gradient(circle at 35% 35%, oklch(95% 0.01 240), oklch(78% 0.04 245)) !important;
        box-shadow: 0 0 10px oklch(80% 0.05 245 / 0.45) !important;
      }
      #jv-game-time {
        font-family: var(--jv-ff-m) !important;
        font-size: 0.8rem !important;
        color: var(--jv-muted) !important;
      }

      /* ── #level-info: keep in DOM for game-JS camera detection, but hide visually ── */
      #level-info {
        position: fixed !important;
        top: -9999px !important;
        left: -9999px !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        z-index: -1 !important;
      }
      #level-xp { width: 100% !important; height: 4px !important; }
      #xp-bar { height: 4px !important; }

      /* ══ ONLINE PLAYERS (top-right) ══ */
      #container {
        position: static !important;
        top: auto !important;
        right: auto !important;
        left: auto !important;
        z-index: auto !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) saturate(1.4) !important;
        padding: 0.5rem 0.9rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        transform: none !important;
        animation: none !important;
        max-width: none !important;
        width: auto !important;
        height: auto !important;
        min-height: 0 !important;
      }
      #info {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        font-size: 0.78rem !important;
        font-weight: 500 !important;
        color: var(--jv-text) !important;
        background: none !important;
        border: none !important;
        padding: 0 !important;
      }
      #info::before {
        content: '' !important;
        display: block !important;
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background: var(--jv-green) !important;
        box-shadow: 0 0 6px var(--jv-green) !important;
        animation: jv-pulse 2s ease-in-out infinite !important;
        flex-shrink: 0 !important;
      }
      #info > div:first-child {
        color: var(--jv-muted) !important;
        font-size: 0.72rem !important;
      }
      #players {
        color: var(--jv-text) !important;
        font-family: var(--jv-ff-m) !important;
        font-size: 0.82rem !important;
        font-weight: 600 !important;
        background: none !important;
      }

      /* ══ SKIP INTRO BUTTON ══ */
      .saltarIntro {
        position: fixed !important;
        bottom: 1.5rem !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        z-index: 2400 !important;
        display: none !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) !important;
        padding: 0.55rem 1.2rem !important;
        cursor: pointer !important;
        transition: border-color 0.2s !important;
        align-items: center !important;
        justify-content: center !important;
      }
      .saltarIntro:hover { border-color: var(--jv-gold) !important; }
      .saltarIntro img {
        display: block !important;
        width: 140px !important;
        height: auto !important;
      }

      /* ══ CHAT BUTTON (bottom-left) ══ */
      #chat-button {
        position: fixed !important;
        bottom: 2rem !important;
        left: 1.5rem !important;
        z-index: 2200 !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.6rem !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) !important;
        padding: 0.55rem 0.9rem !important;
        cursor: pointer !important;
        color: var(--jv-muted) !important;
        font-family: var(--jv-ff) !important;
        font-size: 0.78rem !important;
        font-weight: 500 !important;
        transform: none !important;
        transition: border-color 0.2s, color 0.2s !important;
        animation: jv-slideUp 0.5s 0.35s ease both !important;
        text-decoration: none !important;
        width: fit-content !important;
        max-width: fit-content !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
        right: auto !important;
      }
      #chat-button:hover,
      #chat-button.is-open {
        border-color: var(--jv-gold) !important;
        color: var(--jv-gold) !important;
      }
      #chat-button .nomovil,
      #chat-button .chat-label {
        font-size: 0.72rem !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
      }
      #chat-button > img#toggle-chat {
        width: 16px !important;
        height: 16px !important;
        object-fit: contain !important;
        filter: brightness(0) invert(1) opacity(0.5) !important;
      }
      #chat-button:hover > img#toggle-chat,
      #chat-button.is-open > img#toggle-chat {
        filter: brightness(0) saturate(100%) invert(72%) sepia(56%) saturate(575%) hue-rotate(357deg) brightness(95%) contrast(94%) !important;
      }
      #chat-unread-dot {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background: var(--jv-rose) !important;
        box-shadow: 0 0 6px var(--jv-rose) !important;
        display: none !important;
        flex-shrink: 0 !important;
      }
      #chat-unread-dot.show {
        display: block !important;
      }

      /* ── Chat panel ── */
      #chat-container {
        position: fixed !important;
        bottom: calc(2rem + 40px + 0.5rem) !important;
        left: 1.5rem !important;
        width: 300px !important;
        z-index: 2200 !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) saturate(1.4) !important;
        transform: none !important;
        display: none;
        flex-direction: column !important;
        max-height: 200px !important;
      }
      #chat-container.chat-open,
      #chat-container[style*="flex"],
      #chat-container[style*="block"] {
        display: flex !important;
      }
      #chat-container > p {
        padding: 0.6rem 0.8rem 0.3rem !important;
        font-size: 0.7rem !important;
        color: var(--jv-muted) !important;
        font-weight: 400 !important;
        margin: 0 !important;
        border-bottom: 1px solid var(--jv-border) !important;
      }
      #chat-container > p b { color: var(--jv-text) !important; font-weight: 600 !important; }
      #chat-box {
        padding: 0.5rem 0.8rem !important;
        flex: 1 !important;
        overflow-y: auto !important;
        scrollbar-width: thin !important;
        font-size: 0.8rem !important;
        color: var(--jv-text) !important;
        line-height: 1.5 !important;
        background: none !important;
        border: none !important;
        min-height: 80px !important;
      }
      #chat-input {
        background: transparent !important;
        border: none !important;
        border-top: 1px solid var(--jv-border) !important;
        padding: 0.55rem 0.8rem !important;
        color: var(--jv-text) !important;
        font-family: var(--jv-ff) !important;
        font-size: 0.8rem !important;
        outline: none !important;
        width: 100% !important;
        box-shadow: none !important;
        border-radius: 0 !important;
      }
      #chat-input::placeholder { color: var(--jv-muted) !important; }

      /* ══ SKILL BAR (bottom-center) ══ */
      .wrapperHabilidades {
        position: fixed !important;
        bottom: 2rem !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        z-index: 2200 !important;
        display: flex !important;
        align-items: center !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) saturate(1.4) !important;
        padding: 0.7rem 1rem !important;
        animation: jv-slideUp 0.5s 0.3s ease both !important;
        width: auto !important;
        max-width: calc(100vw - 3rem) !important;
        height: auto !important;
        justify-content: center !important;
      }
      .habilidades {
        position: static !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        background: none !important;
        border: none !important;
        padding: 0 !important;
        transform: none !important;
        width: auto !important;
        max-width: 100% !important;
        height: auto !important;
        justify-content: center !important;
        grid-template-columns: none !important;
      }
      .habilidad {
        position: relative !important;
        width: 56px !important;
        height: 56px !important;
        background: oklch(10% 0.03 255 / 0.8) !important;
        border: 1px solid var(--jv-border) !important;
        cursor: pointer !important;
        transition: border-color 0.2s, background 0.2s !important;
        overflow: visible !important;
        transform: none !important;
        border-radius: 0 !important;
      }
      /* Only show skills without inline display:none (game JS toggles via inline style) */
      .habilidad:not([style*="none"]) {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }
      .habilidad:hover {
        border-color: var(--jv-gold) !important;
        background: oklch(16% 0.04 255 / 0.9) !important;
      }
      .habilidad img {
        width: 32px !important;
        height: 32px !important;
        object-fit: contain !important;
        display: block !important;
        position: static !important;
      }
      .numerohabilidad {
        position: absolute !important;
        bottom: -20px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        font-family: var(--jv-ff-m) !important;
        font-size: 0.58rem !important;
        color: var(--jv-muted) !important;
        background: oklch(8% 0.02 255 / 0.9) !important;
        padding: 1px 4px !important;
        border: 1px solid var(--jv-border) !important;
        white-space: nowrap !important;
      }
      .tiempocorrer {
        position: absolute !important;
        inset: 0 !important;
        background: oklch(5% 0.02 255 / 0.7) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-family: var(--jv-ff-m) !important;
        font-size: 0.9rem !important;
        font-weight: 500 !important;
        color: var(--jv-gold) !important;
        pointer-events: none !important;
      }

      /* ══ ACHIEVEMENT TOAST (top-center) ══ */
      .wrapperLogros {
        position: fixed !important;
        top: 1.5rem !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        z-index: 2500 !important;
        pointer-events: none !important;
        width: auto !important;
        display: flex !important;
        justify-content: center !important;
      }
      .avisoLogro {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        margin: 0 !important;
        background: var(--jv-panel) !important;
        border: 1px solid var(--jv-gold-d) !important;
        backdrop-filter: blur(16px) !important;
        box-shadow: 0 0 30px oklch(74% 0.15 68 / 0.15) !important;
        color: var(--jv-text) !important;
        padding: 0.9rem 1.4rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.8rem !important;
        white-space: nowrap !important;
        font-family: var(--jv-ff) !important;
        opacity: 0 !important;
        transform: translateY(-20px) !important;
        transition: opacity 0.35s ease, transform 0.35s ease !important;
        z-index: 2501 !important;
      }
      .avisoLogro.is-visible {
        opacity: 1 !important;
        transform: translateY(0) !important;
      }
      .avisoLogro__icons {
        display: flex !important;
        align-items: center !important;
        gap: 0.35rem !important;
      }
      .avisoLogro__copy {
        display: flex !important;
        flex-direction: column !important;
        gap: 0.2rem !important;
      }
      .avisoLogro__eyebrow {
        font-size: 0.68rem !important;
        letter-spacing: 0.1em !important;
        text-transform: uppercase !important;
        color: var(--jv-gold) !important;
      }
      .avisoLogro__title {
        font-family: var(--jv-ff-d) !important;
        font-size: 0.95rem !important;
        line-height: 1.2 !important;
        color: var(--jv-text) !important;
        text-transform: none !important;
        letter-spacing: normal !important;
      }
      .avisoLogro img {
        width: 28px !important;
        height: 28px !important;
        object-fit: contain !important;
        flex-shrink: 0 !important;
      }

      /* ── Achievements panel (game JS animates via transform) ── */
      .logros {
        position: fixed !important;
        top: 5rem !important;
        right: 1.5rem !important;
        left: auto !important;
        width: min(260px, calc(100vw - 3rem)) !important;
        background: var(--jv-panel-s) !important;
        border: 1px solid var(--jv-border) !important;
        backdrop-filter: blur(16px) !important;
        color: var(--jv-text) !important;
        padding: 1rem 1.2rem !important;
        z-index: 2100 !important;
      }
      .tituloLogros {
        color: var(--jv-gold) !important;
        font-family: var(--jv-ff-d) !important;
        font-size: 0.7rem !important;
        letter-spacing: 0.14em !important;
        text-transform: uppercase !important;
        margin-bottom: 0.8rem !important;
        border-bottom: 1px solid var(--jv-border) !important;
        padding-bottom: 0.5rem !important;
      }
      .logros h1 {
        font-size: 0.82rem !important;
        font-weight: 400 !important;
        color: var(--jv-muted) !important;
        line-height: 1.5 !important;
        margin-bottom: 0.4rem !important;
        font-family: var(--jv-ff) !important;
        letter-spacing: normal !important;
        text-transform: none !important;
      }

      /* ══ LEVEL UP OVERLAY ══ */
      #scroll {
        position: fixed !important;
        inset: 0 !important;
        z-index: 9000 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: oklch(5% 0.03 255 / 0.85) !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.5s !important;
        transform: none !important;
        border: none !important;
        width: 100% !important;
        height: 100% !important;
      }
      #scroll.scroll-visible,
      #scroll[style*="flex"],
      #scroll[style*="block"] {
        opacity: 1 !important;
        pointer-events: all !important;
      }
      #scroll-info {
        text-align: center !important;
        background: none !important;
        border: none !important;
        padding: 2rem !important;
        max-width: 420px !important;
        transform: none !important;
      }
      #scroll-title {
        font-family: var(--jv-ff-d) !important;
        font-size: 1.8rem !important;
        line-height: 1.3 !important;
        margin-bottom: 1rem !important;
        text-align: center !important;
        background: linear-gradient(135deg, var(--jv-gold), oklch(90% 0.2 80)) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        color: var(--jv-gold) !important;
      }
      #scroll-text {
        color: var(--jv-muted) !important;
        font-size: 0.92rem !important;
        margin-top: 0.8rem !important;
        line-height: 1.6 !important;
        text-align: center !important;
        font-family: var(--jv-ff) !important;
      }
      #scroll-button {
        margin-top: 2rem !important;
        background: none !important;
        border: 1px solid var(--jv-border) !important;
        color: var(--jv-muted) !important;
        padding: 0.6rem 1.5rem !important;
        cursor: pointer !important;
        font-family: var(--jv-ff) !important;
        font-size: 0.8rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        transition: color 0.2s, border-color 0.2s !important;
        display: inline-block !important;
        border-radius: 0 !important;
      }
      #scroll-button:hover { color: var(--jv-gold) !important; border-color: var(--jv-gold) !important; }

      /* ══ PORTAL DIALOGS ══ */
      .wrapperSenal {
        position: fixed !important;
        inset: 0 !important;
        z-index: 7999 !important;
        pointer-events: none !important;
      }
      .wrapperSenal > div {
        position: fixed !important;
        inset: 0 !important;
        z-index: 8000 !important;
        display: none !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        background:
          radial-gradient(circle at 50% 38%, color-mix(in oklab, var(--jv-dialog-accent) 16%, transparent), transparent 42%),
          linear-gradient(to bottom, color-mix(in oklab, var(--jv-dialog-accent) 10%, transparent), transparent 35%),
          oklch(5% 0.03 255 / 0.78) !important;
        pointer-events: all !important;
        gap: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        min-width: 100vw !important;
        min-height: 100vh !important;
        padding: 1.5rem !important;
        box-sizing: border-box !important;
        margin: 0 !important;
      }
      .senalIdaIM,
      .senalMusica,
      .senalIdaIR,
      .senalRelatos,
      .senalIdaIL,
      .senalLibros,
      .senalVueltaIM,
      .senalVueltaIR,
      .senalVueltaIL {
        --jv-dialog-accent: var(--jv-gold);
        --jv-dialog-accent-border: var(--jv-border-g);
        --jv-dialog-accent-shadow: rgba(224, 161, 45, 0.1);
      }
      .senalIdaIM,
      .senalMusica {
        --jv-dialog-accent: oklch(80% 0.14 68);
        --jv-dialog-accent-border: oklch(62% 0.12 68 / 0.52);
        --jv-dialog-accent-shadow: rgba(238, 180, 70, 0.14);
      }
      .senalIdaIR,
      .senalRelatos {
        --jv-dialog-accent: oklch(77% 0.1 40);
        --jv-dialog-accent-border: oklch(58% 0.09 40 / 0.5);
        --jv-dialog-accent-shadow: rgba(224, 140, 84, 0.13);
      }
      .senalIdaIL,
      .senalLibros {
        --jv-dialog-accent: oklch(78% 0.09 95);
        --jv-dialog-accent-border: oklch(60% 0.08 95 / 0.5);
        --jv-dialog-accent-shadow: rgba(214, 188, 98, 0.13);
      }
      .senalVueltaIM,
      .senalVueltaIR,
      .senalVueltaIL {
        --jv-dialog-accent: oklch(78% 0.08 215);
        --jv-dialog-accent-border: oklch(56% 0.07 215 / 0.48);
        --jv-dialog-accent-shadow: rgba(120, 170, 255, 0.12);
      }
      .wrapperSenal > div[style*="flex"],
      .wrapperSenal > div[style*="block"],
      .wrapperSenal > div.visible {
        display: flex !important;
      }
      /* Card box: top half (h1) */
      .wrapperSenal > div > h1 {
        padding: 2.2rem 2.8rem 1.5rem !important;
        background: var(--jv-panel-s) !important;
        border: 1px solid var(--jv-dialog-accent-border) !important;
        border-bottom: none !important;
        backdrop-filter: blur(20px) !important;
        width: min(380px, calc(100vw - 2rem)) !important;
        font-family: var(--jv-ff-d) !important;
        font-size: 1.15rem !important;
        letter-spacing: 0.03em !important;
        font-weight: 700 !important;
        color: var(--jv-text) !important;
        line-height: 1.5 !important;
        text-align: center !important;
        text-shadow: none !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 140px !important;
        box-shadow: 0 0 36px var(--jv-dialog-accent-shadow) !important;
      }
      .jv-dialog-rune {
        width: min(380px, calc(100vw - 2rem)) !important;
        margin: 0 !important;
        padding: 1.8rem 2.8rem 0 !important;
        background: var(--jv-panel-s) !important;
        border: 1px solid var(--jv-dialog-accent-border) !important;
        border-bottom: none !important;
        color: var(--jv-dialog-accent) !important;
        text-align: center !important;
        font-family: var(--jv-ff-d) !important;
        font-size: 2.1rem !important;
        line-height: 1 !important;
        box-sizing: border-box !important;
        text-shadow: 0 0 18px var(--jv-dialog-accent-shadow) !important;
      }
      .jv-dialog-rune span {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 62px !important;
        height: 62px !important;
        border-radius: 50% !important;
        border: 1px solid color-mix(in oklab, var(--jv-dialog-accent) 38%, transparent) !important;
        background: radial-gradient(circle, color-mix(in oklab, var(--jv-dialog-accent) 18%, transparent), color-mix(in oklab, var(--jv-dialog-accent) 4%, transparent) 65%, transparent 70%) !important;
        box-shadow: 0 0 28px var(--jv-dialog-accent-shadow) !important;
        transform-origin: center !important;
      }
      .jv-dialog-rune--music span {
        color: oklch(80% 0.14 68) !important;
        animation: jv-runeMusic 2.8s ease-in-out infinite, jv-runePulse 2s ease-in-out infinite !important;
      }
      .jv-dialog-rune--stories span {
        color: oklch(77% 0.1 40) !important;
        animation: jv-runeStories 3.1s ease-in-out infinite, jv-runePulseSoft 2.3s ease-in-out infinite !important;
      }
      .jv-dialog-rune--books span {
        color: oklch(78% 0.09 95) !important;
        animation: jv-runeBooks 3.6s ease-in-out infinite, jv-runePulseSoft 2.8s ease-in-out infinite !important;
      }
      .jv-dialog-rune--return span {
        color: oklch(78% 0.08 215) !important;
        animation: jv-runeReturn 3.4s ease-in-out infinite, jv-runePulseReturn 2.6s ease-in-out infinite !important;
      }
      @keyframes jv-runeMusic {
        0%, 100% { transform: translateY(0) scale(1) rotate(-4deg); }
        25% { transform: translateY(-3px) scale(1.04) rotate(3deg); }
        50% { transform: translateY(-1px) scale(1.08) rotate(-2deg); }
        75% { transform: translateY(-4px) scale(1.03) rotate(4deg); }
      }
      @keyframes jv-runeStories {
        0%, 100% { transform: translateY(0) scale(1) rotate(0deg); }
        30% { transform: translateY(-5px) scale(1.05) rotate(-6deg); }
        55% { transform: translateY(0) scale(0.98) rotate(4deg); }
        80% { transform: translateY(-2px) scale(1.03) rotate(-3deg); }
      }
      @keyframes jv-runeBooks {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-3px) scale(1.06); }
      }
      @keyframes jv-runeReturn {
        0%, 100% { transform: translateY(0) scale(1) rotate(0deg); }
        50% { transform: translateY(-2px) scale(1.02) rotate(10deg); }
      }
      @keyframes jv-runePulse {
        0%, 100% {
          box-shadow: 0 0 18px rgba(224, 161, 45, 0.08);
          border-color: rgba(224, 161, 45, 0.22);
        }
        50% {
          box-shadow: 0 0 34px rgba(224, 161, 45, 0.18);
          border-color: rgba(224, 161, 45, 0.42);
        }
      }
      @keyframes jv-runePulseSoft {
        0%, 100% {
          box-shadow: 0 0 16px rgba(224, 161, 45, 0.06);
          border-color: rgba(224, 161, 45, 0.18);
        }
        50% {
          box-shadow: 0 0 26px rgba(224, 161, 45, 0.14);
          border-color: rgba(224, 161, 45, 0.34);
        }
      }
      @keyframes jv-runePulseReturn {
        0%, 100% {
          box-shadow: 0 0 14px rgba(120, 170, 255, 0.07);
          border-color: rgba(120, 170, 255, 0.18);
        }
        50% {
          box-shadow: 0 0 24px rgba(120, 170, 255, 0.14);
          border-color: rgba(120, 170, 255, 0.3);
        }
      }
      .jv-dialog-sub {
        width: min(380px, calc(100vw - 2rem)) !important;
        margin: 0 !important;
        padding: 0 2.8rem 1.3rem !important;
        background: var(--jv-panel-s) !important;
        border-left: 1px solid var(--jv-dialog-accent-border) !important;
        border-right: 1px solid var(--jv-dialog-accent-border) !important;
        color: var(--jv-muted) !important;
        font-family: var(--jv-ff) !important;
        font-size: 0.84rem !important;
        line-height: 1.65 !important;
        text-align: center !important;
        box-sizing: border-box !important;
      }
      /* Card box: bottom half (.botones) */
      .botones {
        display: flex !important;
        gap: 0.8rem !important;
        justify-content: center !important;
        padding: 1.5rem 2.8rem 2.2rem !important;
        background: var(--jv-panel-s) !important;
        border: 1px solid var(--jv-dialog-accent-border) !important;
        border-top: none !important;
        width: min(380px, calc(100vw - 2rem)) !important;
        backdrop-filter: blur(20px) !important;
        margin: 0 !important;
        box-sizing: border-box !important;
        box-shadow: 0 18px 48px color-mix(in srgb, var(--jv-dialog-accent-shadow) 90%, transparent) !important;
      }
      .botones > div {
        padding: 0.65rem 2rem !important;
        font-family: var(--jv-ff) !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        cursor: pointer !important;
        transition: opacity 0.2s, color 0.2s, border-color 0.2s !important;
        border-radius: 0 !important;
        min-width: 160px !important;
        text-align: center !important;
      }
      .botones > div:first-child {
        background: var(--jv-gold) !important;
        color: oklch(7% 0.025 255) !important;
        border: none !important;
      }
      .botones > div:first-child:hover { opacity: 0.85 !important; }
      .botones > div:last-child {
        background: none !important;
        border: 1px solid var(--jv-border) !important;
        color: var(--jv-muted) !important;
      }
      .botones > div:last-child:hover {
        color: var(--jv-text) !important;
        border-color: var(--jv-text) !important;
      }

      /* ══ CAMERA INTRO STATE ══ */
      body.jv-camera-intro .jv-player-card,
      body.jv-camera-intro #level-info,
      body.jv-camera-intro .wrapperHabilidades,
      body.jv-camera-intro #chat-button,
      body.jv-camera-intro #chat-container,
      body.jv-camera-intro #container,
      body.jv-camera-intro .wrapperLogros,
      body.jv-camera-intro .logros,
      body.jv-camera-intro .marcoMinimapa {
        display: none !important;
      }
      body.jv-camera-intro .logos {
        display: block !important;
        position: fixed !important;
        inset: 0 !important;
        z-index: 2100 !important;
        pointer-events: none !important;
        opacity: 0.9 !important;
      }
      body.jv-camera-intro .logos1,
      body.jv-camera-intro .logos2,
      body.jv-camera-intro .logos3,
      body.jv-camera-intro .logos4 {
        display: block !important;
        position: fixed !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        text-align: center !important;
        width: min(80vw, 300px) !important;
        opacity: 0.85 !important;
      }
      body.jv-camera-intro .logos1 { top: 12% !important; }
      body.jv-camera-intro .logos2 { top: 30% !important; }
      body.jv-camera-intro .logos3 { top: 48% !important; }
      body.jv-camera-intro .logos4 { top: 64% !important; }
      body.jv-camera-intro .logos1 img,
      body.jv-camera-intro .logos2 img,
      body.jv-camera-intro .logos3 img,
      body.jv-camera-intro .logos4 img {
        max-width: 100% !important;
        height: auto !important;
      }
      body.jv-camera-intro .dedicatoria { display: none !important; }
      body.jv-camera-intro.jv-camera-dedication .dedicatoria {
        display: block !important;
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        z-index: 2200 !important;
        max-width: min(80vw, 400px) !important;
        opacity: 0.9 !important;
      }
      body.jv-camera-intro.jv-camera-dedication .dedicatoria img {
        display: block !important;
        max-width: 100% !important;
        height: auto !important;
      }
      body.jv-camera-intro .saltarIntro {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }

      /* ── Camera dedication overlay ── */
      .jv-camera-dedication-overlay {
        position: fixed !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        bottom: 8rem !important;
        width: min(88vw, 380px) !important;
        z-index: 2300 !important;
        display: none !important;
        opacity: 0 !important;
      }
      .jv-camera-dedication-overlay img {
        display: block !important;
        width: 100% !important;
        height: auto !important;
        opacity: 0.88 !important;
      }
      body.jv-camera-intro .jv-camera-dedication-overlay {
        display: block !important;
        opacity: 0.9 !important;
      }

      /* ══ RESPONSIVE ══ */
      @media (max-width: 768px) {
        .jv-player-card {
          top: 1rem !important;
          left: 0.8rem !important;
          min-width: 0 !important;
          padding: 0.5rem 0.7rem 0.5rem 0.5rem !important;
          gap: 0.5rem !important;
        }
        .jv-player-card__ring { width: 36px !important; height: 36px !important; }
        .jv-player-card__avatar { width: 36px !important; height: 36px !important; }
        .jv-player-card__name { font-size: 0.78rem !important; }
        .jv-player-card__badge { font-size: 0.5rem !important; padding: 1px 3px !important; bottom: -5px !important; right: -5px !important; }
        .jv-player-card__xp-label { font-size: 0.55rem !important; }

        .marcoMinimapa {
          top: calc(1rem + 62px + 0.6rem) !important;
          left: 0.8rem !important;
          width: 170px !important;
          padding: 5px !important;
        }
        .minimap { width: 160px !important; height: 160px !important; max-width: 160px !important; max-height: 160px !important; }

        #level-info {
          top: -9999px !important;
          left: 0.8rem !important;
          width: 160px !important;
        }

        #jv-world-info {
          top: 1rem !important;
          right: 0.8rem !important;
          gap: 0.4rem !important;
          flex-direction: column !important;
          align-items: flex-end !important;
        }
        #jv-btn-blog {
          width: 36px !important;
          height: 36px !important;
        }
        #container {
          padding: 0.4rem 0.7rem !important;
        }
        #info { font-size: 0.7rem !important; gap: 0.35rem !important; }
        #jv-time-chip {
          padding: 0.35rem 0.6rem !important;
          font-size: 0.7rem !important;
        }
        .jv-time-sun {
          width: 14px !important;
          height: 14px !important;
        }

        .wrapperHabilidades {
          bottom: 7.25rem !important;
          top: auto !important;
          left: 50% !important;
          right: auto !important;
          width: auto !important;
          height: auto !important;
          padding: 0.5rem 0.7rem !important;
          max-width: calc(100vw - 1.6rem) !important;
          justify-content: center !important;
          align-items: center !important;
          transform: translateX(-50%) !important;
        }
        .habilidades {
          position: static !important;
          top: auto !important;
          right: auto !important;
          bottom: auto !important;
          left: auto !important;
          width: auto !important;
          height: auto !important;
          display: flex !important;
          flex-direction: row !important;
          flex-wrap: wrap !important;
          justify-content: center !important;
          align-items: center !important;
          gap: 4px !important;
          transform: none !important;
        }
        .habilidad { width: 44px !important; height: 44px !important; }
        .habilidad:not([style*="none"]) { display: flex !important; align-items: center !important; justify-content: center !important; }
        .habilidad img { width: 24px !important; height: 24px !important; }
        .numerohabilidad { display: none !important; }

        #chat-button {
          bottom: 0.8rem !important;
          left: 0.8rem !important;
          padding: 0.45rem 0.7rem !important;
          font-size: 0.72rem !important;
        }
        #chat-container {
          bottom: calc(0.8rem + 38px + 0.4rem) !important;
          left: 0.8rem !important;
          width: min(280px, calc(100vw - 1.6rem)) !important;
        }

        .wrapperLogros { top: 1rem !important; }
        .avisoLogro {
          padding: 0.65rem 1rem !important;
          white-space: normal !important;
        }
        .avisoLogro__title { font-size: 0.82rem !important; }

        #scroll-title { font-size: 1.4rem !important; }

        .wrapperSenal > div > h1 {
          font-size: 1rem !important;
          padding: 1.6rem 1.4rem 1.2rem !important;
          min-height: 0 !important;
        }
        .jv-dialog-rune {
          padding: 1.25rem 1.4rem 0 !important;
          font-size: 1.7rem !important;
        }
        .jv-dialog-rune span {
          width: 52px !important;
          height: 52px !important;
        }
        .jv-dialog-sub {
          padding: 0 1.4rem 1rem !important;
          font-size: 0.78rem !important;
        }
        .botones { padding: 1.2rem 1.4rem 1.6rem !important; }
        .botones {
          flex-direction: column !important;
          align-items: stretch !important;
        }
        .botones > div {
          padding: 0.7rem 1rem !important;
          font-size: 0.8rem !important;
          min-width: 0 !important;
          width: 100% !important;
        }

        body.jv-camera-intro .saltarIntro {
          bottom: 1rem !important;
        }
      }

      @media (max-width: 480px) {
        .wrapperHabilidades {
          bottom: 6.5rem !important;
          max-width: calc(100vw - 1rem) !important;
        }
        .habilidades {
          gap: 3px !important;
        }
        #chat-container { width: calc(100vw - 1.6rem) !important; }
      }

    </style>
    <!-- Carga Ammo.js explícitamente ANTES de tu bundle
    <script src="/js/ammo/ammo.wasm.js"></script>   -->
    <?php
    // Para depurar el contenido de $viteAssets:
    // echo "<!-- DEBUG VITE ASSETS:\n";
    // var_dump($viteAssets);
    // echo "\n-->\n";
    // exit; // Descomenta para ver solo esto y el HTML anterior

    echo $viteAssets;
    ?>


</head>
<body>
    <div class="extras">
        <audio class="intro" src="/media/sounds/intro.mp3"></audio>
        <audio class="birds" src="/media/sounds/birds.mp3"></audio>
        <video class="particulas" src="/media/videos/particulas.mp4" autoplay muted loop></video>
        <video class="abstract" src="/media/videos/resumen.mp4" autoplay muted loop></video>
    </div>

    <div class="logos">
        <div class="logos1">
            <img src="/media/img/logos/Unreal-Engine.jpg" class="unreal">
            <img src="/media/img/logos/docs-icon-TweenJS.png" class="tween">
        </div>
        <div class="logos2">
            <img src="/media/img/logos/threejs.png" class="three">
            <img src="/media/img/logos/Stack_Overflow-Logo.wine.png" class="stackoverflow">
        </div>
        <div class="logos3">
            <img src="/media/img/logos/logo-firebase.png" class="firebase">
        </div>
        <div class="logos4">
            <img class="gemini" src="/media/img/logos/logo-gemini.jpeg">
        </div>
        <div class="dedicatoria"><img src="/media/img/logos/dedicatoria.png"></div>
    </div>

    <div class="wrapperLogros">
        <div class="avisoLogro">
            <div class="avisoLogro__icons" aria-hidden="true">
                <img src="/media/img/fa2.gif" alt="">
                <img src="/media/img/fa1.gif" alt="">
            </div>
            <div class="avisoLogro__copy">
                <div class="avisoLogro__eyebrow">Logro desbloqueado</div>
                <div class="avisoLogro__title" id="jv-achievement-title">Aprendiendo a moverse</div>
            </div>
        </div>
    </div>

    <!--
        EMPIEZA MUSICA
-->
    <div class="musica">
        <div class="salirMusica">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/CRISTAL/index.php';
        ?>
    </div>
<!--    
        FIN MUSICA
    -->
    <!--
        RELATOS
-->
    <div class="todoRelatos">
        <div class="salirRelatos">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/RELATOS/index.php';
        ?>
    </div>
<!--    
        FIN RELATOS
    -->
    <!--
       LIBROS
-->   
    <div class="todoLibros">
        <div class="salirLibros">
            <img src="/media/img/salirPiedraRunica.png">
        </div>
        <?php
        include_once __DIR__ . '/api/LIBROS/index.php';
        ?>
    </div>
<!--   
        FIN LIBROS
    -->


    <div class="wrapperSenal">
        <div class="senalIdaIM">
            <h1>¿Quieres viajar<br><br>a la isla de la Música?</h1>
            <div class="botones">
                <div class="siIdaIM">SI</div>
                <div class="noIdaIM">NO</div>
            </div>
        </div>
        <div class="senalVueltaIM">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIM">SI</div>
                <div class="noVueltaIM">NO</div>
            </div>
        </div>
        <div class="senalMusica">
            <h1>¿Quieres activar el<br><br>portal de la Música?</h1>
            <div class="botones">
                <div class="simusica">SI</div>
                <div class="nomusica">NO</div>
            </div>
        </div>

        <div class="senalIdaIR">
            <h1>¿Quieres viajar<br><br>a la isla de los Relatos?</h1>
            <div class="botones">
                <div class="siIdaIR">SI</div>
                <div class="noIdaIR">NO</div>
            </div>
        </div>
        <div class="senalVueltaIR">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIR">SI</div>
                <div class="noVueltaIR">NO</div>
            </div>
        </div>
        <div class="senalRelatos">
            <h1>¿Quieres activar el<br><br>portal de los Relatos Cortos?</h1>
            <div class="botones">
                <div class="sirelatos">SI</div>
                <div class="norelatos">NO</div>
            </div>
        </div>

        <div class="senalIdaIL">
            <h1>¿Quieres viajar<br><br>a la isla de los Libros?</h1>
            <div class="botones">
                <div class="siIdaIL">SI</div>
                <div class="noIdaIL">NO</div>
            </div>
        </div>
        <div class="senalVueltaIL">
            <h1>¿Quieres viajar<br><br>de vuelta al pueblo?</h1>
            <div class="botones">
                <div class="siVueltaIL">SI</div>
                <div class="noVueltaIL">NO</div>
            </div>
        </div>
        <div class="senalLibros">
            <h1>¿Quieres activar el<br><br>portal de los Libros?</h1>
            <div class="botones">
                <div class="silibros">SI</div>
                <div class="nolibros">NO</div>
            </div>
        </div>

    </div>


    <div class="saltarIntro">
        <img src="/media/img/saltarIntro.png">
    </div>



    <div class="jvintro" id="jvintro-overlay" aria-label="Acceso al Pueblo de los Dragones">
        <div class="jvintro__stars"></div>
        <div class="jvintro__nebula"></div>

        <section class="jvintro__screen" id="jvintro-screen-welcome">
            <div class="jvintro__welcome-hero">
                <div class="jvintro__logo"><img src="/media/img/firma-transparente-blanco.png" alt="Josico Vila"></div>
                <div class="jvintro__eyebrow">Mundo 3D · Multijugador</div>
                <h1 class="jvintro__title">EL PUEBLO DE<br><span class="jvintro__gold">LOS DRAGONES</span></h1>
                <p class="jvintro__desc">Un mundo 3D en tiempo real donde explorar portales, descubrir relatos, escuchar música y encontrarte con otros viajeros.</p>

                <div class="jvintro__actions">
                    <button class="jvintro__btn" id="jvintro-btn-start">ELIGE TU AVATAR &nbsp; →</button>
                </div>
                <div class="jvintro__note">Usa <strong>WASD</strong> + ratón para moverte · Audio recomendado · <a href="https://josicovila.es/blog/guia-nuevos-jugadores/">Guía de inicio</a></div>
                <div class="jvintro__scrollhint" aria-hidden="true"><span></span></div>
            </div>
        </section>

        <section class="jvintro__screen is-hidden" id="jvintro-screen-avatar">
            <button class="jvintro__back" id="jvintro-btn-back">← Volver</button>
            <div class="jvintro__avatar-head">
                <div class="jvintro__step">Paso 1 de 1</div>
                <h2 class="jvintro__avatar-title">Elige tu leyenda</h2>
            </div>
            <div class="jvintro__avatar-wrap">
                <button class="jvintro__arrow" id="jvintro-prev" aria-label="Avatar anterior">‹</button>
                <div class="jvintro__card">
                    <div class="jvintro__visual"><img id="jvintro-avatar-image" src="/intro/images/Dragon_Evolved.gif" alt="Avatar"></div>
                    <div class="jvintro__info">
                        <div class="jvintro__family" id="jvintro-avatar-family">Familia Dragones</div>
                        <h3 class="jvintro__name" id="jvintro-avatar-name">DRAGOON</h3>
                        <p class="jvintro__tagline" id="jvintro-avatar-tagline">Cazador de tesoros nato</p>
                        <div class="jvintro__bio" id="jvintro-avatar-bio">Lleva poco tiempo en el pueblo, pero ya se ha hecho un hueco entre los habitantes. Disfruta resolviendo puzzles y acertijos que le lleven al encuentro de tesoros. Te será de gran ayuda en la búsqueda de los portales.</div>
                        <div class="jvintro__stats">
                            <div class="jvintro__stat"><small>Tamaño</small><span id="jvintro-stat-size">1.5 m</span></div>
                            <div class="jvintro__stat"><small>Peso</small><span id="jvintro-stat-weight">60 kg</span></div>
                            <div class="jvintro__stat"><small>Edad</small><span id="jvintro-stat-age">252 años</span></div>
                            <div class="jvintro__stat"><small>Velocidad</small><span id="jvintro-stat-speed">Normal</span></div>
                        </div>
                        <button class="jvintro__enter" id="jvintro-enter" disabled>Preparando mundo…</button>
                        <div class="jvintro__load" id="jvintro-load">
                            <div class="jvintro__loadbar"><div class="jvintro__loadfill" id="jvintro-loadfill"></div></div>
                            <div class="jvintro__loadmeta">
                                <span class="jvintro__loadtext" id="jvintro-loadtext">Cargando mundo… 0%</span>
                                <span class="jvintro__loadhint" id="jvintro-loadhint">Espera a que termine la carga para entrar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="jvintro__arrow" id="jvintro-next" aria-label="Avatar siguiente">›</button>
            </div>
            <div class="jvintro__dots" id="jvintro-dots"></div>
        </section>
    </div>


    <!-- Intro -->
    <div class="wrapperPergamino" style="background: url('/intro/images/fondo-josico.png') repeat center center">
        
    <!--<video class="videoFondoIntro" src="/intro/video/fondo-blancoynegro.mp4" poster="/intro/video/poster.png" autoplay loop muted></video>-->
        <div class="logoIntro">
            <img src="/intro/images/Josico-Vila-letras.png">
        </div>
        
        <div class="wrapperExplicaciones">
            <div class="explicaciones">
                <h1 style="color: lime">Bienvenid@,</h1>
                <p>Me hace mucha ilusión presentarte este mini mundo en tres dimensiones en el que, con ayuda de tu Avatar,
                deberás adentrarte en una serie de portales repartidos por el pueblo protagonista. Cuando estés list@, continúa.
                </p>
            </div>
            <div class="explicaciones-movile">
                <h1 style="color: lime">Fase Beta para móviles</h1>
                <p>Estás probando una fase no terminada del juego en su versión para móviles. Algunas cosas como las
                    islas flotantes no están terminadas, disculpa las molestias. Estamos trabajando para cambiarlo.
                    Tienes la versión final en su versión para ordenadores de sobremesa. Disfruta.
                </p>
            </div>
            <div class="videosExplicaciones">
                <div class="video1 nomovil">
                    <img src="/intro/images/movimiento.png" style="width: 100%; height: auto" />
                </div>
                <div class="video2 nomovil">
                    <h2 style="color: lime">¡Atención!</h2>
                    - Este juego utiliza diferentes sonidos, ajusta tu volumen.<br>
                    - Prueba el multijugador online en un mismo PC en diferentes navegadores.<br>
                    - El movimiento del personaje es el típico 'WASD' + botón izquierdo del ratón.<br>
                    <br>
                    <span style="color: lime">¡Diviértete! ¡Descúbreme!</span>
                </div>
            </div>
            <div class="wrapperSenalIntro">
                <img src="/intro/images/senal-continua.png" class="elegirAvatar">
            </div>
        </div>


        <div class="carousel">
            <div class="list">
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Dragon_Evolved.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Dragoon</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Cazador de tesoros nato. Lleva poco tiempo en el pueblo, pero ya se ha hecho un hueco entre los habitantes.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Dragoon</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Disfruta resolviendo puzzles y acertijos que le lleven al encuentro de tesoros. Te será de gran ayuda en la búsqueda de los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.5m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>60Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Dragones</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>252 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Dragon_Evolved" data-nombre="Dragoon">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Goleling.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Goleling</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Máscota del jefe del pueblo. Lleva con él desde que este paso su rito de iniciación a la caza a los 18 años.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Goleling</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Siendo la mascota del cabecilla del pueblo tiene que estar siempre dispuesto para ayudarlo en todas sus tareas que incluye la de guardar los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.0m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>35Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Murciélagos</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>???</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Goleling" data-nombre="Goleling">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: white;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Pigeon.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Pigeon</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            Lo encontraron cuando era un cachorro, abandonado en la puerta principal del pueblo.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Pigeon</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Con el paso del tiempo y como agradecimiento por cuidar de él, se ha convertido en una de las mascotas cazadoras más importantes del pueblo.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>1.1m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>40Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Aves</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>177 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Pigeon" data-nombre="Pigeon">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="item">
                    <img class="avatarIntro" src="/intro/images/Demon.gif">
                    <div class="introduce">
                        <div class="title">AVATAR</div>
                        <div class="topic">Fera</div>
                        <div class="des">
                            <!-- 20 lorem -->
                            La más revoltosa de los cuatro. Aprovecha cualquier ocasión para gastar bromas a sus compañeros.
                        </div>
                        <button class="seeMore">Más Información &#8599;</button>
                    </div>
                    <div class="detail">
                        <div class="title">Fera</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Su actitud le ha traido problemas alguna vez, pero no deja de ser trabajadora y seguro que te acompañará con gusto a buscar los portales.
                        </div>
                        <div class="specifications">
                            <div>
                                <p>Tamaño</p>
                                <p>0.9m</p>
                            </div>
                            <div>
                                <p>Peso</p>
                                <p>28Kg</p>
                            </div>
                            <div>
                                <p>Familia</p>
                                <p>Dragones</p>
                            </div>
                            <div>
                                <p>Velocidad</p>
                                <p>Normal</p>
                            </div>
                            <div>
                                <p>Edad</p>
                                <p>98 años</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <button class="login" style="border: 1px solid white" data-avatar="Demon" data-nombre="Fera">
                                <div class="progress-container">
                                    <div class="progress-bar"></div>
                                    <span class="progress-text">Cargando... 0%</span>
                                </div>
                                <span class="button-text" style="display: none;">Entrar al Juego</span>                            
                            </button>
                            <div class="loading-messages" style="display: none; font-style: italic; color: #ccc;">
                                <span>Dándole de comer a los dragones...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="arrows">
                <button id="prev">&lt;</button>
                <button id="next">&gt;</button>
                <button id="back">Volver a todos&#8599;</button>
            </div>
        </div>
        
       
    </div> <!-- intro -->

<!-- Partes de la interfaz -->
    <div class="marcoAvatar" style="right: -390px;">
        <div class="jugador">
            <img src="/media/img/avatar/conMarco/Demon.gif">
        </div>
        <div class="nombreUsuario">
            <span class="player-name-display">Hansik</span>, niv. <span class="nivel-actual">1</span>
        </div>
    </div>
    
    <div class="marcoMinimapa" aria-label="Minimapa del mundo">
        <div class="jv-minimap__label">Minimapa</div>
        <canvas class="minimap" width="208" height="208"></canvas>
    </div>
    <div class="logros" style="transform: translateX(-1000px);">
        <div class="tituloLogros">LOGROS</div>
        <h1 class="logroAndar">Aprendiendo a moverse</h1>
        <h1 class="logroMusica">Abre el Portal de la Música</h1>
        <h1 class="logroRelatos">Abre el Portal de los Relatos Cortos</h1>
        <h1 class="logroLibros">Abre el Portal de los Libros</h1>
    </div>

    <div class="wrapperHabilidades" style="transform: translateY(500px);">
        <div class="listonhabilidades nomovil">
            <img src="/media/img/iconoshabilidades/maderahabilidades.png">
        </div>
        <div class="habilidades">
            <div class="habilidad habilidadteletransporte">
                <img src="/media/img/iconoshabilidades/teletransporte.png" title="Teletransporte al centro del pueblo">
                <div class="numerohabilidad">1</div>
            </div>
            <div class="habilidad habilidadcorrer">
                <div class="tiempocorrer"></div>
                <img src="/media/img/iconoshabilidades/run.png" title="Aumentar la velocidad durante 3 segundos">
                <div class="numerohabilidad">2</div>
            </div>
            <div class="habilidad habilidadlibros" style="display: none;" title="Teletransporte a la isla de los libros">
                <img src="/media/img/iconoshabilidades/libros.png">
                <div class="numerohabilidad">3</div>
            </div>
            <div class="habilidad habilidadrelatos" style="display: none;" title="Teletransporte a la isla de los relatos cortos">
                <img src="/media/img/iconoshabilidades/relatos.png">
                <div class="numerohabilidad">4</div>
            </div>
            <div class="habilidad habilidadmusica" style="display: none;" title="Teletransporte a la isla de la música">
                <img src="/media/img/iconoshabilidades/musica.png">
                <div class="numerohabilidad">5</div>
            </div>
        </div>
    </div>

<!-- Fin Partes de la interfaz -->

<!-- Botón y ventana de CHAT -->

<div id="chat-container">
    <p style="color: white"><b>Chatea con otros jugadores de JosicoVila.es</b></p>
    <div id="chat-box"></div>
    <input type="text" id="chat-input" placeholder="Escribe tu mensaje...">
    <button id="send-btn">Enviar</button>
</div>
<div id="chat-button" role="button" aria-expanded="false" aria-controls="chat-container" tabindex="0">
    <div class="nomovil chat-label" style="color: white">CHAT</div>
    <img src="/media/img/chat.png" id="toggle-chat" style="width: 50px; height: auto; cursor: pointer;" alt="chat de JosicoVila.es" title="chat de JosicoVila.es">
    <div id="chat-unread-dot" aria-hidden="true"></div>
</div>

<!-- FIN CHAT -->

<!-- MÓDULO EXPERIENCE-->
<div id="level-info">
    <!-- <div><span style="font-size: 20px;">Niv.</span id="level-number">0</div> -->
    <div id="level-xp">
        <div id="xp-bar"></div>
    </div>
    <div id="level-envelope">
    <img src="/media/img/envelope.png" id="envelope" class="jello-horizontal">
    </div>        
</div>

<div id="scroll">
    <div id="scroll-info">
        <div class="color-carmesi" style="font-size: 30px; text-align: center; margin-top: 20px;" id="scroll-title">¡¡¡Felicidades por llegar al nivel 1!!!</div>
        <div class="color-carmesi" style="font-size: 20px; text-align: left; margin-top: 20px;" id="scroll-text">Muchas gracias por jugar en JosicoVila.es, ánimo sigue descubriendo todo lo que ofrece este mini mundo.</div>
        <div id="scroll-close" style="text-align: center; margin-top: 20px;">
            <button id="scroll-button">Cerrar</button>
        </div>
    </div>
</div>
<!-- FIN MÓDULO EXPERIENCE-->
<!-- JUGADORES ONLINE -->
<div id="jv-world-info" aria-label="Estado del mundo">
    <a href="/" id="jv-btn-blog" title="Volver al blog" aria-label="Volver al blog de JosicoVila.es">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
    </a>
    <div id="container">
        <div id="info">
        <div>Jugadores online </div><div id="players"></div>
        </div>
    </div>
    <div id="jv-time-chip" aria-live="polite">
        <div class="jv-time-sun" id="jv-time-sun" aria-hidden="true"></div>
        <span id="jv-game-time">--:--</span>
    </div>
</div>
<!-- FIN JUGADORES ONLINE -->

<!-- INDICADOR DIA/NOCHE -->
<!-- Contenedor para el arco (opcional, ayuda a posicionar) -->
<div id="time-arc-container"> 
    <img id="time-arc-icon" src="/media/img/ui/sun-icon.png" alt="Time"> <!-- Icono que se moverá -->
    <!-- En algún lugar visible de tu body -->
    <div id="player-count" style="position: absolute; bottom: 0px; left: 50%;transform: translateX(-50%); color: black; font-size: 15px; font-weight: bold; z-index: 100; width: 100%; text-align: center; background-color: rgba(255,255,255, 0.5); border-radius: 20px;">Jugadores: 1</div>

</div>
<!-- FIN INDICADOR DIA/NOCHE -->

<!-- Mensaje de Advertencia para Múltiples Conexiones -->
<div id="multiple-connections-warning" style="z-index: -1;opacity: 0;display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); color: white; z-index: 99999; justify-content: center; align-items: center; text-align: center; font-size: 24px; padding: 20px;">
    Ya tienes una sesión activa de JosicoVila.es abierta en otra pestaña de este navegador.<br><br>
    Por favor, cierra esta pestaña y vuelve a la anterior. Utiliza otro navegador para tener multiples sesiones abiertas.<br><br><br>
    Muchas gracias,<br>
    JosicoVila.es<br>
</div>
<!-- FIN Mensaje de Advertencia para Múltiples Conexiones -->


    <script type="x-shader/x-vertex" id="vertexshader">

    
    </script>

    <script type="x-shader/x-fragment" id="fragmentshader">

    
    </script>    
    
    

<script>
(function(){
  const overlay = document.getElementById('jvintro-overlay');
  if (!overlay) return;
  const welcome = document.getElementById('jvintro-screen-welcome');
  const avatarScreen = document.getElementById('jvintro-screen-avatar');
  const startBtn = document.getElementById('jvintro-btn-start');
  const backBtn = document.getElementById('jvintro-btn-back');
  const prevBtn = document.getElementById('jvintro-prev');
  const nextBtn = document.getElementById('jvintro-next');
  const enterBtn = document.getElementById('jvintro-enter');
  const dotsWrap = document.getElementById('jvintro-dots');
  const hiddenButtons = Array.from(document.querySelectorAll('.wrapperPergamino .login'));
  const avatars = [
    {
      key: 'Dragoon', image: '/intro/images/Dragon_Evolved.gif', family: 'Familia Dragones', name: 'DRAGOON',
      tagline: 'Cazador de tesoros nato',
      bio: 'Lleva poco tiempo en el pueblo, pero ya se ha hecho un hueco entre los habitantes. Disfruta resolviendo puzzles y acertijos que le lleven al encuentro de tesoros. Te será de gran ayuda en la búsqueda de los portales.',
      size: '1.5 m', weight: '60 kg', age: '252 años', speed: 'Normal'
    },
    {
      key: 'Goleling', image: '/intro/images/Goleling.gif', family: 'Familia Murciélagos', name: 'GOLELING',
      tagline: 'Mascota del jefe del pueblo',
      bio: 'Lleva con el jefe desde que este pasó su rito de iniciación a la caza a los 18 años. Siendo la mascota del cabecilla del pueblo tiene que estar siempre dispuesto para ayudarlo en todas sus tareas, incluida la de guardar los portales.',
      size: '1.0 m', weight: '35 kg', age: '???', speed: 'Normal'
    },
    {
      key: 'Pigeon', image: '/intro/images/Pigeon.gif', family: 'Familia Aves', name: 'PIGEON',
      tagline: 'Encontrado siendo cachorro',
      bio: 'Lo encontraron cuando era un cachorro, abandonado en la puerta principal del pueblo. Con el paso del tiempo y como agradecimiento por cuidar de él, se ha convertido en una de las mascotas cazadoras más importantes del pueblo.',
      size: '1.1 m', weight: '40 kg', age: '177 años', speed: 'Normal'
    },
    {
      key: 'Fera', image: '/intro/images/Demon.gif', family: 'Familia Dragones', name: 'FERA',
      tagline: 'La más revoltosa de los cuatro',
      bio: 'Aprovecha cualquier ocasión para gastar bromas a sus compañeros. Su actitud le ha traído problemas alguna vez, pero no deja de ser trabajadora y seguro que te acompañará con gusto a buscar los portales.',
      size: '0.9 m', weight: '28 kg', age: '98 años', speed: 'Normal'
    }
  ];
  const els = {
    image: document.getElementById('jvintro-avatar-image'),
    family: document.getElementById('jvintro-avatar-family'),
    name: document.getElementById('jvintro-avatar-name'),
    tagline: document.getElementById('jvintro-avatar-tagline'),
    bio: document.getElementById('jvintro-avatar-bio'),
    size: document.getElementById('jvintro-stat-size'),
    weight: document.getElementById('jvintro-stat-weight'),
    age: document.getElementById('jvintro-stat-age'),
    speed: document.getElementById('jvintro-stat-speed')
  };
  let current = 0;

  avatars.forEach((avatar, idx) => {
    const dot = document.createElement('button');
    dot.className = 'jvintro__dot';
    dot.type = 'button';
    dot.setAttribute('aria-label', avatar.key);
    dot.addEventListener('click', () => renderAvatar(idx));
    dotsWrap.appendChild(dot);
  });

  const dots = Array.from(dotsWrap.querySelectorAll('.jvintro__dot'));
  const swipeTarget = document.querySelector('#jvintro-screen-avatar .jvintro__card');
  const loadFill = document.getElementById('jvintro-loadfill');
  const loadText = document.getElementById('jvintro-loadtext');
  const loadHint = document.getElementById('jvintro-loadhint');
  let touchStartX = 0;
  let touchStartY = 0;
  let touchActive = false;
  let hudReady = false;
  let readyTarget = null;
  let syncTimer = null;

  function renderAvatar(idx){
    current = (idx + avatars.length) % avatars.length;
    const avatar = avatars[current];
    els.image.src = avatar.image;
    els.image.alt = avatar.key;
    els.family.textContent = avatar.family;
    els.name.textContent = avatar.name;
    els.tagline.textContent = avatar.tagline;
    els.bio.textContent = avatar.bio;
    els.size.textContent = avatar.size;
    els.weight.textContent = avatar.weight;
    els.age.textContent = avatar.age;
    els.speed.textContent = avatar.speed;
    dots.forEach((dot, i) => dot.classList.toggle('is-active', i === current));
    syncLoadingState();
  }

  function showAvatarScreen(){
    welcome.classList.add('is-hidden');
    avatarScreen.classList.remove('is-hidden');
  }
  function showWelcomeScreen(){
    avatarScreen.classList.add('is-hidden');
    welcome.classList.remove('is-hidden');
  }

  function getTargetButton(){
    const avatar = avatars[current];
    return hiddenButtons.find(btn => btn.dataset.nombre === avatar.key) || null;
  }

  function syncLoadingState(){
    const target = getTargetButton();
    readyTarget = target;
    if (!target) {
      enterBtn.disabled = true;
      enterBtn.textContent = 'Preparando mundo…';
      loadFill.style.width = '0%';
      loadText.textContent = 'Cargando mundo…';
      loadHint.textContent = 'No se encontró el botón original';
      hudReady = false;
      return;
    }

    const bar = target.querySelector('.progress-bar');
    const text = target.querySelector('.progress-text');
    const buttonText = target.querySelector('.button-text');
    const loadingMsg = target.parentElement && target.parentElement.querySelector('.loading-messages span');

    const width = bar && bar.style.width ? bar.style.width : '0%';
    const textValue = text && text.textContent ? text.textContent.trim() : 'Cargando mundo…';
    const visibleButton = buttonText && getComputedStyle(buttonText).display !== 'none';
    const disabled = !!target.disabled;
    const parsed = parseFloat(width);
    const percent = Number.isFinite(parsed) ? Math.max(0, Math.min(100, parsed)) : 0;

    loadFill.style.width = percent + '%';
    loadText.textContent = textValue || ('Cargando mundo… ' + Math.round(percent) + '%');

    if (visibleButton && !disabled) {
      hudReady = true;
      enterBtn.disabled = false;
      enterBtn.innerHTML = '▷&nbsp;&nbsp;Entrar al juego';
      loadHint.textContent = 'Mundo cargado. Ya puedes entrar';
      if (percent < 100) loadFill.style.width = '100%';
      if (!loadText.textContent.includes('100')) {
        loadText.textContent = 'Cargando mundo… 100%';
      }
    } else {
      hudReady = false;
      enterBtn.disabled = true;
      enterBtn.textContent = 'Preparando mundo…';
      loadHint.textContent = loadingMsg && loadingMsg.textContent ? loadingMsg.textContent.trim() : 'Espera a que termine la carga para entrar';
    }
  }

  function startLoadingSync(){
    syncLoadingState();
    if (syncTimer) return;
    syncTimer = setInterval(syncLoadingState, 150);
  }

  function showSkipIntroDuringCamera(){
    const skip = document.querySelector('.saltarIntro');
    if (!skip) return;

    document.body.classList.add('jv-camera-intro');


    const finishCameraIntro = () => {
        document.body.classList.remove('jv-camera-intro');
      skip.style.display = 'none';
    };

    const reveal = () => {
      if (overlay && overlay.style.display !== 'none') return false;
      skip.style.display = 'flex';
      return true;
    };

    const onSkipClick = () => {
      finishCameraIntro();
      skip.removeEventListener('click', onSkipClick);
    };
    skip.addEventListener('click', onSkipClick);

    // Primer intento un poco después de entrar, cuando ya ha arrancado la animación de cámara
    setTimeout(reveal, 900);


    // Observa el estado final del HUD original y quita el modo intro cuando termina la cámara
    let tries = 0;
    const timer = setInterval(() => {
      tries += 1;

      const levelInfo = document.querySelector('#level-info');
      const levelInfoReady = levelInfo && (levelInfo.style.display === 'flex' || levelInfo.style.display === 'block');

      if (levelInfoReady) {
        finishCameraIntro();
        skip.removeEventListener('click', onSkipClick);
        clearInterval(timer);
        return;
      }

      reveal();

      if (tries > 160) {
        finishCameraIntro();
        skip.removeEventListener('click', onSkipClick);
        clearInterval(timer);
      }
    }, 250);
  }

  function bridgeToGame(){
    syncLoadingState();
    const avatar = avatars[current];
    const target = readyTarget || getTargetButton();
    if (!target) {
      alert('No se encontró el botón original para ' + avatar.key);
      return;
    }
    if (!hudReady) {
      enterBtn.disabled = true;
      enterBtn.textContent = 'Preparando mundo…';
      loadHint.textContent = 'El mundo sigue cargando. Espera al 100%';
      return;
    }
    enterBtn.disabled = true;
    enterBtn.textContent = 'Entrando…';
    if (typeof window.jvUpdatePlayerCard === 'function') {
      window.jvUpdatePlayerCard(avatar.key);
    }
    showSkipIntroDuringCamera();
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    setTimeout(() => {
      overlay.style.display = 'none';
      target.click();
    }, 120);
  }

  startBtn.addEventListener('click', () => {
    showAvatarScreen();
    startLoadingSync();
  });
  backBtn.addEventListener('click', showWelcomeScreen);
  prevBtn.addEventListener('click', () => renderAvatar(current - 1));
  nextBtn.addEventListener('click', () => renderAvatar(current + 1));
  enterBtn.addEventListener('click', bridgeToGame);

  if (swipeTarget) {
    swipeTarget.addEventListener('touchstart', (e) => {
      if (!e.touches || !e.touches.length) return;
      touchStartX = e.touches[0].clientX;
      touchStartY = e.touches[0].clientY;
      touchActive = true;
    }, { passive: true });

    swipeTarget.addEventListener('touchend', (e) => {
      if (!touchActive || !e.changedTouches || !e.changedTouches.length) return;
      const dx = e.changedTouches[0].clientX - touchStartX;
      const dy = e.changedTouches[0].clientY - touchStartY;
      touchActive = false;

      if (Math.abs(dx) < 40 || Math.abs(dx) < Math.abs(dy)) return;

      if (dx < 0) {
        renderAvatar(current + 1);
      } else {
        renderAvatar(current - 1);
      }
    }, { passive: true });
  }
  document.addEventListener('keydown', function(e){
    if (!overlay || overlay.style.display === 'none') return;
    if (!avatarScreen.classList.contains('is-hidden')) {
      if (e.key === 'ArrowLeft') renderAvatar(current - 1);
      if (e.key === 'ArrowRight') renderAvatar(current + 1);
      if (e.key === 'Escape') showWelcomeScreen();
    }
  });

  startLoadingSync();
  renderAvatar(0);
})();
</script>

    <div class="jv-camera-dedication-overlay" aria-hidden="true">
        <img src="/media/img/logos/dedicatoria.png" alt="Hecho con mucho amor para todos mis sobrinos">
    </div>

    <div class="jv-player-card" aria-live="polite">
        <div class="jv-player-card__ring">
            <img class="jv-player-card__avatar" src="/intro/images/Dragon_Evolved.gif" alt="Avatar del jugador">
            <span class="jv-player-card__badge" id="jv-player-level">NIV.1</span>
        </div>
        <div class="jv-player-card__meta">
            <div class="jv-player-card__name" id="jv-player-name">Dragoon</div>
            <div class="jv-player-card__xp-label">
                <span>Experiencia</span><span id="jv-xp-val"></span>
            </div>
            <div class="jv-player-card__xp-track">
                <div class="jv-player-card__xp-fill" id="jv-pc-xp-fill"></div>
            </div>
        </div>
    </div>



<script>
/* Player card: updated by jvintro bridgeToGame() via window.jvUpdatePlayerCard */
window.jvAvatarMap = {
  dragoon:  { name: 'Dragoon',  img: '/intro/images/Dragon_Evolved.gif' },
  fera:     { name: 'Fera',     img: '/intro/images/Demon.gif' },
  goleling: { name: 'Goleling', img: '/intro/images/Goleling.gif' },
  pigeon:   { name: 'Pigeon',   img: '/intro/images/Pigeon.gif' }
};
window.jvUpdatePlayerCard = function(avatarKey) {
  const data = window.jvAvatarMap[(avatarKey || '').toLowerCase()];
  if (!data) return;
  const nameEl   = document.getElementById('jv-player-name');
  const avatarEl = document.querySelector('.jv-player-card__avatar');
  if (nameEl)   nameEl.textContent = data.name;
  if (avatarEl) avatarEl.src = data.img;
};

/* XP sync: mirror #xp-bar width → .jv-player-card__xp-fill */
(function(){
  const xpBar  = document.getElementById('xp-bar');
  const pcFill = document.getElementById('jv-pc-xp-fill');
  const xpVal  = document.getElementById('jv-xp-val');
  if (!xpBar || !pcFill) return;
  const sync = () => {
    const inlineWidth = xpBar.style.width || '';
    const computedWidth = getComputedStyle(xpBar).width;
    const parentWidth = xpBar.parentElement ? getComputedStyle(xpBar.parentElement).width : '';
    let nextWidth = inlineWidth;

    if (!nextWidth && computedWidth && parentWidth) {
      const fillPx = parseFloat(computedWidth);
      const parentPx = parseFloat(parentWidth);
      if (Number.isFinite(fillPx) && Number.isFinite(parentPx) && parentPx > 0) {
        nextWidth = `${Math.max(0, Math.min(100, (fillPx / parentPx) * 100))}%`;
      }
    }

    pcFill.style.setProperty('width', nextWidth || '0%', 'important');
    if (xpVal) {
      const rounded = Math.round(parseFloat(pcFill.style.width) || 0);
      xpVal.textContent = `${rounded}% XP`;
    }
  };
  sync();
  new MutationObserver(sync).observe(xpBar, { attributes: true, attributeFilter: ['style', 'class'] });
  if (xpBar.parentElement && typeof ResizeObserver !== 'undefined') {
    new ResizeObserver(sync).observe(xpBar.parentElement);
  }
})();

/* Level sync: mirror .nivel-actual text → #jv-player-level badge */
(function(){
  const badge    = document.getElementById('jv-player-level');
  const nivelEl  = document.querySelector('.nivel-actual');
  if (!badge || !nivelEl) return;
  const syncLevel = () => {
    const n = parseInt(nivelEl.textContent, 10);
    if (Number.isFinite(n) && n > 0) badge.textContent = 'NIV.' + n;
  };
  syncLevel();
  new MutationObserver(syncLevel).observe(nivelEl, { childList: true, characterData: true, subtree: true });
})();
</script>

<script>
(function(){
  // Mostrar el número de jugadores online de forma robusta
  const toast = document.querySelector('.avisoLogro');
  const toastTitle = document.getElementById('jv-achievement-title');
  const achievementItems = Array.from(document.querySelectorAll('.logros h1'));
  let toastTimer = null;

  const showAchievementToast = (title) => {
    if (!toast || !toastTitle || !title) return;
    toastTitle.textContent = title;
    toast.classList.remove('is-visible');
    if (toastTimer) clearTimeout(toastTimer);
    requestAnimationFrame(() => {
      toast.classList.add('is-visible');
      toastTimer = setTimeout(() => {
        toast.classList.remove('is-visible');
      }, 3600);
    });
  };

  achievementItems.forEach((item) => {
    let unlocked = false;
    const syncUnlockedState = () => {
      const style = getComputedStyle(item);
      const isUnlocked = style.textDecorationLine.includes('line-through')
        || style.color === 'rgb(144, 238, 144)'
        || item.style.textDecoration.includes('line-through')
        || item.style.color === 'lightgreen';

      if (isUnlocked && !unlocked) {
        unlocked = true;
        showAchievementToast(item.textContent.trim());
      }
    };

    syncUnlockedState();
    new MutationObserver(syncUnlockedState).observe(item, {
      attributes: true,
      attributeFilter: ['style', 'class']
    });
  });

  const info = document.getElementById('info');
  const players = document.getElementById('players');
  const playerCount = document.getElementById('player-count');
  if (info && players) {
    const syncPlayers = () => {
      const countText = (playerCount && playerCount.textContent ? playerCount.textContent : '').trim();
      const countMatch = countText.match(/jugadores:\s*(\d+)/i);
      if (countMatch) {
        players.textContent = countMatch[1];
        return;
      }

      const txt = (players.textContent || '').trim();
      if (!/^\d{1,2}$/.test(txt)) {
        players.textContent = '1';
      }
    };
    syncPlayers();
    setInterval(syncPlayers, 500);
  }

  // Fallback visual para el avatar: no romper si la imagen no existe
  const avatarEl = document.querySelector('.jv-player-card__avatar');
  if (avatarEl) {
    avatarEl.addEventListener('error', () => {
      avatarEl.style.opacity = '0';
    }, { once: true });
  }

  // Reforzar que las habilidades sigan siendo clicables
  document.querySelectorAll('.habilidad').forEach((el) => {
    el.style.pointerEvents = 'auto';
  });
})();
</script>

<script>
(function(){
  const chatButton = document.getElementById('chat-button');
  const chatToggle = document.getElementById('toggle-chat');
  const chatContainer = document.getElementById('chat-container');
  const chatBox = document.getElementById('chat-box');
  const unreadDot = document.getElementById('chat-unread-dot');
  const timeLabel = document.getElementById('jv-game-time');
  const timeArcIcon = document.getElementById('time-arc-icon');
  const timeSun = document.getElementById('jv-time-sun');

  if (chatButton && chatToggle) {
    const openChat = () => chatToggle.click();

    chatButton.addEventListener('click', (event) => {
      if (event.target === chatToggle) return;
      openChat();
    });

    chatButton.addEventListener('keydown', (event) => {
      if (event.key !== 'Enter' && event.key !== ' ') return;
      event.preventDefault();
      openChat();
    });
  }

  const syncChatState = () => {
    if (!chatButton || !chatContainer) return;
    const isOpen = chatContainer.classList.contains('chat-open')
      || chatContainer.style.display === 'block'
      || chatContainer.style.display === 'flex';

    chatButton.classList.toggle('is-open', isOpen);
    chatButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

    if (isOpen && unreadDot) {
      unreadDot.classList.remove('show');
    }
  };

  if (chatContainer) {
    syncChatState();
    new MutationObserver(syncChatState).observe(chatContainer, {
      attributes: true,
      attributeFilter: ['style', 'class']
    });
  }

  if (chatBox && unreadDot) {
    let initialised = false;
    const observer = new MutationObserver((mutations) => {
      if (!initialised) {
        initialised = true;
        return;
      }
      const hasNewNodes = mutations.some((mutation) => mutation.addedNodes.length > 0);
      const isOpen = chatContainer && (
        chatContainer.classList.contains('chat-open')
        || chatContainer.style.display === 'block'
        || chatContainer.style.display === 'flex'
      );
      if (hasNewNodes && !isOpen) {
        unreadDot.classList.add('show');
      }
    });
    observer.observe(chatBox, { childList: true });
    initialised = true;
  }

  const syncVisibleClock = () => {
    if (timeLabel) {
      timeLabel.textContent = new Date().toLocaleTimeString('es-ES', {
        hour: '2-digit',
        minute: '2-digit'
      });
    }

    if (timeArcIcon && timeSun) {
      const isMoon = /moon-icon/i.test(timeArcIcon.getAttribute('src') || '');
      timeSun.classList.toggle('is-moon', isMoon);
    }
  };

  syncVisibleClock();
  setInterval(syncVisibleClock, 10000);
})();
</script>

<script>
(function(){
  const portalDialogSubtitleMap = new Map([
    ['.senalIdaIM', 'Las melodías antiguas resuenan al otro lado del portal.'],
    ['.senalVueltaIM', 'El eco del pueblo te llama de vuelta a casa.'],
    ['.senalMusica', 'La piedra rúnica vibra con acordes listos para despertar.'],
    ['.senalIdaIR', 'Las historias olvidadas aguardan entre páginas y sombras.'],
    ['.senalVueltaIR', 'El camino de regreso al pueblo sigue abierto para ti.'],
    ['.senalRelatos', 'Las voces de los relatos quieren abrirse paso en este rincón.'],
    ['.senalIdaIL', 'Los libros dormidos te esperan con secretos entre sus tapas.'],
    ['.senalVueltaIL', 'El pueblo aún guarda sendas y secretos por recorrer.'],
    ['.senalLibros', 'La biblioteca del portal late con conocimiento antiguo.'],
  ]);
  const portalDialogRuneMap = new Map([
    ['.senalIdaIM',   { symbol: '♫', cls: 'jv-dialog-rune--music' }],
    ['.senalMusica',  { symbol: '♫', cls: 'jv-dialog-rune--music' }],
    ['.senalIdaIR',   { symbol: '✦', cls: 'jv-dialog-rune--stories' }],
    ['.senalRelatos', { symbol: '✦', cls: 'jv-dialog-rune--stories' }],
    ['.senalIdaIL',   { symbol: '❖', cls: 'jv-dialog-rune--books' }],
    ['.senalLibros',  { symbol: '❖', cls: 'jv-dialog-rune--books' }],
    ['.senalVueltaIM',{ symbol: '◌', cls: 'jv-dialog-rune--return' }],
    ['.senalVueltaIR',{ symbol: '◌', cls: 'jv-dialog-rune--return' }],
    ['.senalVueltaIL',{ symbol: '◌', cls: 'jv-dialog-rune--return' }],
  ]);

  const portalDialogCopy = [
    ['.senalIdaIM h1', '¿Quieres viajar a la isla de la Música?'],
    ['.senalVueltaIM h1', '¿Quieres regresar al pueblo?'],
    ['.senalMusica h1', '¿Quieres activar el portal de la Música?'],
    ['.senalIdaIR h1', '¿Quieres viajar a la isla de los Relatos?'],
    ['.senalVueltaIR h1', '¿Quieres regresar al pueblo?'],
    ['.senalRelatos h1', '¿Quieres activar el portal de los Relatos Cortos?'],
    ['.senalIdaIL h1', '¿Quieres viajar a la isla de los Libros?'],
    ['.senalVueltaIL h1', '¿Quieres regresar al pueblo?'],
    ['.senalLibros h1', '¿Quieres activar el portal de los Libros?'],
  ];

  const portalDialogActions = [
    '.siIdaIM', '.siVueltaIM', '.simusica',
    '.siIdaIR', '.siVueltaIR', '.sirelatos',
    '.siIdaIL', '.siVueltaIL', '.silibros'
  ];

  const portalDialogDismiss = [
    '.noIdaIM', '.noVueltaIM', '.nomusica',
    '.noIdaIR', '.noVueltaIR', '.norelatos',
    '.noIdaIL', '.noVueltaIL', '.nolibros'
  ];

  portalDialogCopy.forEach(([selector, text]) => {
    const node = document.querySelector(selector);
    if (node) node.textContent = text;
  });

  portalDialogRuneMap.forEach(({ symbol, cls }, selector) => {
    const dialog = document.querySelector(selector);
    if (!dialog) return;

    let rune = dialog.querySelector('.jv-dialog-rune');
    if (!rune) {
      rune = document.createElement('div');
      rune.className = 'jv-dialog-rune';
      const title = dialog.querySelector('h1');
      if (title) {
        title.insertAdjacentElement('beforebegin', rune);
      } else {
        dialog.prepend(rune);
      }
    }

    rune.className = `jv-dialog-rune ${cls}`;
    rune.innerHTML = `<span aria-hidden="true">${symbol}</span>`;
  });

  portalDialogSubtitleMap.forEach((text, selector) => {
    const dialog = document.querySelector(selector);
    if (!dialog) return;

    let sub = dialog.querySelector('.jv-dialog-sub');
    if (!sub) {
      sub = document.createElement('p');
      sub.className = 'jv-dialog-sub';
      const title = dialog.querySelector('h1');
      if (title) {
        title.insertAdjacentElement('afterend', sub);
      } else {
        dialog.prepend(sub);
      }
    }
    sub.textContent = text;
  });

  portalDialogActions.forEach((selector) => {
    const node = document.querySelector(selector);
    if (node) node.textContent = 'Sí, adelante';
  });

  portalDialogDismiss.forEach((selector) => {
    const node = document.querySelector(selector);
    if (node) node.textContent = 'No, tal vez en otro momento';
  });
})();
</script>

</body>
</html>
