@extends('layouts.app')

@section('title', 'Essencial Pro - Equipamentos de Segurança do Trabalho')

@push('styles')
<style>
    .category-explorer {
        background: #f8fafc;
        padding: 2rem 0 2.25rem;
    }
    .category-explorer .section-heading {
        margin-bottom: 1rem;
    }
    .category-explorer-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 0.85rem;
    }
    .home-section-carousel {
        position: relative;
    }
    .home-section-carousel.owl-carousel .owl-stage-outer {
        padding: 0.15rem 0 0.35rem;
    }
    .home-section-carousel.owl-carousel .owl-nav {
        margin-top: 0.65rem;
        display: flex;
        justify-content: center;
        gap: 0.55rem;
    }
    .home-section-carousel.owl-carousel .owl-nav button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        border: none;
        background: #f97316 !important;
        color: #fff !important;
        font-size: 0.95rem;
        line-height: 1;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.28);
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .home-section-carousel.owl-carousel .owl-nav button:hover {
        background: #ea580c !important;
        transform: translateY(-1px);
    }
    .home-section-carousel.owl-carousel .owl-dots {
        margin-top: 0.55rem;
        line-height: 1;
    }
    .home-section-carousel.owl-carousel .owl-dot span {
        width: 8px;
        height: 8px;
        margin: 4px 5px;
        background: #cbd5e1;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .home-section-carousel.owl-carousel .owl-dot.active span,
    .home-section-carousel.owl-carousel .owl-dot:hover span {
        background: #f97316;
        transform: scale(1.1);
    }
    .home-section-carousel.owl-carousel .category-explorer-card,
    .home-section-carousel.owl-carousel .professional-solution-card,
    .home-section-carousel.owl-carousel .best-seller-card {
        height: 100%;
    }
    .category-explorer-card {
        display: block;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.85rem 0.7rem 0.8rem;
        text-align: center;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .category-explorer-card:hover {
        transform: translateY(-2px);
        border-color: #f97316;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
    }
    .category-explorer-card img {
        width: 100%;
        max-width: 126px;
        aspect-ratio: 1 / 1;
        object-fit: contain;
        margin: 0 auto;
        display: block;
    }
    .category-explorer-card h4 {
        margin: 0.55rem 0 0.25rem;
        color: #0f172a;
        font-size: clamp(0.9rem, 1.05vw, 1.1rem);
        font-weight: 700;
    }
    .category-explorer-card span {
        color: #f97316;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .professional-catalogs {
        background: #f8fafc;
        padding: 0.25rem 0 2.5rem;
    }
    .professional-catalogs .section-heading {
        margin-bottom: 1.15rem;
    }
    .professional-catalogs-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
        align-items: stretch;
    }
    .professional-catalog-card {
        position: relative;
        display: block;
        aspect-ratio: 1024 / 387;
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .professional-catalog-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
    }
    .professional-catalog-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        display: block;
        transition: transform 0.35s ease;
    }
    .professional-catalog-card:hover img {
        transform: scale(1.015);
    }
    .professional-catalog-cta {
        position: absolute;
        bottom: 0.55rem;
        right: 0.75rem;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.85);
        border-radius: 4px;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: clamp(0.6rem, 0.75vw, 0.7rem);
        font-weight: 700;
        letter-spacing: 0.35px;
        text-transform: uppercase;
        line-height: 1.2;
        transition: background 0.2s ease, border-color 0.2s ease;
    }
    .professional-catalog-card:hover .professional-catalog-cta {
        background: rgba(15, 23, 42, 0.72);
        border-color: #fff;
    }
    .professional-catalog-card--portwest .professional-catalog-cta {
        right: auto;
        left: 0.75rem;
    }
    .professional-catalog-card--portwest img {
        object-position: 20% center;
    }
    .professional-solutions {
        background: #f8fafc;
        padding: 0.3rem 0 2.4rem;
    }
    .professional-solutions .section-heading {
        margin-bottom: 1.15rem;
    }
    .professional-solutions-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }
    .professional-solution-card {
        display: block;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .professional-solution-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
    }
    .professional-solution-card-image {
        width: 100%;
        aspect-ratio: 16 / 10;
        object-fit: cover;
        display: block;
    }
    .professional-solution-card-body {
        text-align: center;
        padding: 0.9rem 0.8rem 0.95rem;
    }
    .professional-solution-card-title {
        margin: 0;
        color: #0f1d4d;
        font-size: clamp(1rem, 1.2vw, 1.35rem);
        font-weight: 900;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .professional-solution-card-title i {
        color: #f97316;
        font-size: 1.1em;
    }
    .professional-solution-card-text {
        margin: 0.35rem 0 0.6rem;
        color: #64748b;
        font-size: clamp(0.82rem, 0.95vw, 0.96rem);
    }
    .professional-solution-card-cta {
        color: #f97316;
        font-size: 0.95rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }
    .best-sellers-section {
        padding: 1.5rem 0 2.6rem;
        background: #fff;
    }
    .best-sellers-header {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin-bottom: 0.9rem;
    }
    .best-sellers-header .section-heading {
        margin-bottom: 0;
        flex: 1;
    }
    .best-sellers-all-link {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        color: #0f1d4d;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .best-sellers-all-link:hover {
        color: #f97316;
    }
    .best-sellers-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 0.9rem;
    }
    .best-sellers-grid.owl-carousel.owl-loaded {
        display: block;
    }
    .best-seller-card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        padding: 0.7rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .best-seller-image-link {
        display: block;
        text-align: center;
        margin-bottom: 0.45rem;
    }
    .best-seller-image {
        width: 100%;
        max-width: 135px;
        aspect-ratio: 1 / 1;
        object-fit: contain;
    }
    .best-seller-title {
        margin: 0 0 0.25rem;
        color: #111827;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.3;
        min-height: 2.4em;
    }
    .best-seller-stars {
        color: #f59e0b;
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        margin-bottom: 0.2rem;
    }
    .best-seller-price {
        color: #111827;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    .best-seller-btn {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background: #f97316;
        color: #fff;
        border-radius: 6px;
        padding: 0.55rem 0.6rem;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 800;
        font-size: 0.74rem;
        letter-spacing: 0.35px;
    }
    .best-seller-btn:hover {
        color: #fff;
        background: #ea580c;
    }
    .about-highlight-section {
        padding: 2.5rem 0;
        background: #fff;
    }
    .about-highlight-grid {
        display: grid;
        grid-template-columns: 1.05fr 1.1fr 0.95fr;
        gap: 1.25rem;
        align-items: stretch;
    }
    .about-media-card {
        background: #fff;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }
    .about-media-wrap {
        position: relative;
        background: #f1f5f9;
        height: 100%;
    }
    .about-media-wrap img {
        width: 100%;
        height: 100%;
        min-height: 320px;
        object-fit: cover;
        object-position: center;
        display: block;
    }
    .tech-performance-section {
        padding: 0;
        background: #fff;
    }
    .tech-performance-banner-section {
        padding: 0 0 2.5rem;
        background: #fff;
    }
    .tech-performance-banner {
        position: relative;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        background: #f4f6f8;
    }
    .tech-performance-banner__media {
        width: 100%;
        height: auto;
        display: block;
        vertical-align: middle;
    }
    .tech-performance-banner__content {
        position: absolute;
        inset: 0 auto 0 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0;
        padding: clamp(1.25rem, 2.5vw, 2rem) clamp(1.5rem, 4vw, 3rem) clamp(1.25rem, 2.5vw, 2rem) clamp(0.5rem, 1.5vw, 1rem);
        width: min(48%, 34rem);
        z-index: 2;
        pointer-events: none;
    }
    .tech-performance-banner__content a {
        pointer-events: auto;
    }
    .tech-performance-banner__title {
        margin: 0;
        font-family: "Rubik", sans-serif;
        font-weight: 900;
        font-size: clamp(1.45rem, 3vw, 2.5rem);
        line-height: 1.1;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .tech-performance-banner__title-main {
        color: #0f172a;
    }
    .tech-performance-banner__title-accent {
        color: #f97316;
    }
    .tech-performance-banner__subtitle {
        margin: 0.7rem 0 0;
        color: #5b6b7d;
        font-size: clamp(0.84rem, 1.3vw, 1.05rem);
        font-weight: 500;
        line-height: 1.5;
        max-width: 26rem;
    }
    .tech-performance-banner__features {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: clamp(0.75rem, 1.6vw, 1.35rem);
        margin-top: clamp(1rem, 2vw, 1.5rem);
        align-items: stretch;
    }
    .tech-performance-banner__feature {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 0;
    }
    .tech-performance-banner__feature-head {
        display: flex;
        align-items: flex-end;
        min-height: 2.15rem;
        width: 100%;
        margin-bottom: 0.45rem;
    }
    .tech-performance-banner__feature-logo {
        display: block;
        width: auto;
        max-width: 100%;
        max-height: 1.9rem;
        height: auto;
        margin: 0;
        object-fit: contain;
        object-position: left bottom;
    }
    .tech-performance-banner__brand {
        display: block;
        margin: 0;
        font-family: "Rubik", sans-serif;
        font-weight: 800;
        font-size: clamp(0.78rem, 1.15vw, 0.98rem);
        line-height: 1.15;
        letter-spacing: -0.01em;
    }
    .tech-performance-banner__brand--drynair {
        color: #1a1a1a;
    }
    .tech-performance-banner__brand--drynair .accent {
        color: #f97316;
    }
    .tech-performance-banner__brand--smellstop {
        color: #1a1a1a;
    }
    .tech-performance-banner__brand--smellstop .accent {
        color: #f97316;
    }
    .tech-performance-banner__feature-title {
        margin: 0 0 0.4rem;
        color: #1a1a1a;
        font-family: "Rubik", sans-serif;
        font-size: clamp(0.64rem, 0.92vw, 0.78rem);
        font-weight: 800;
        line-height: 1.35;
        letter-spacing: 0.035em;
        text-transform: uppercase;
        min-height: 2.7em;
    }
    .tech-performance-banner__feature-text {
        margin: 0;
        color: #5f6b7a;
        font-size: clamp(0.6rem, 0.84vw, 0.74rem);
        font-weight: 500;
        line-height: 1.5;
        flex: 1;
    }
    .tech-performance-banner__cta {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        align-self: flex-start;
        margin-top: clamp(1rem, 2vw, 1.35rem);
        padding: 0.65rem 0.6rem 0.65rem 1.2rem;
        border-radius: 999px;
        background: #f97316;
        color: #fff;
        font-family: "Rubik", sans-serif;
        font-size: clamp(0.64rem, 0.95vw, 0.78rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        text-decoration: none;
        box-shadow: 0 6px 16px rgba(249, 115, 22, 0.32);
        transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }
    .tech-performance-banner__cta:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(234, 88, 12, 0.36);
    }
    .tech-performance-banner__cta:focus-visible {
        outline: 3px solid rgba(249, 115, 22, 0.35);
        outline-offset: 2px;
    }
    .tech-performance-banner__cta-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: clamp(22px, 2.2vw, 28px);
        height: clamp(22px, 2.2vw, 28px);
        border-radius: 50%;
        background: #fff;
        color: #f97316;
        flex-shrink: 0;
        font-size: 0.85em;
    }
    .tech-performance-banner__note {
        margin: 0.6rem 0 0;
        color: #8896a8;
        font-size: clamp(0.56rem, 0.76vw, 0.66rem);
        font-weight: 500;
        line-height: 1.45;
        max-width: 24rem;
    }
    @media (max-width: 991.98px) {
        .tech-performance-banner__content {
            width: min(52%, 30rem);
            padding-left: clamp(0.35rem, 1vw, 0.75rem);
        }
        .tech-performance-banner__title {
            font-size: clamp(1.15rem, 2.3vw, 1.85rem);
        }
        .tech-performance-banner__features {
            gap: 0.5rem;
        }
    }
    @media (max-width: 767.98px) {
        .tech-performance-banner-section {
            padding: 0 0 1.75rem;
        }
        .tech-performance-banner-section .container {
            padding-left: 0;
            padding-right: 0;
        }
        .tech-performance-banner {
            display: flex;
            flex-direction: column;
            border-radius: 0;
            background: #fff;
        }
        .tech-performance-banner__media {
            order: 1;
            width: 100%;
            height: clamp(210px, 54vw, 290px);
            object-fit: cover;
            object-position: 68% center;
        }
        .tech-performance-banner__content {
            position: static;
            width: 100%;
            transform: none;
            padding: 1.35rem 1.35rem 1.5rem;
            background: #fff;
            pointer-events: auto;
        }
        .tech-performance-banner__title {
            white-space: normal;
            font-size: clamp(1.5rem, 6.8vw, 2rem);
            line-height: 1.1;
        }
        .tech-performance-banner__subtitle {
            margin-top: 0.55rem;
            font-size: clamp(0.92rem, 3.8vw, 1rem);
            max-width: 100%;
            line-height: 1.55;
            color: #475569;
        }
        .tech-performance-banner__features {
            grid-template-columns: 1fr;
            gap: 0.7rem;
            margin-top: 1.1rem;
        }
        .tech-performance-banner__feature {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0.9rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        .tech-performance-banner__feature-head {
            min-height: auto;
            margin-bottom: 0.35rem;
        }
        .tech-performance-banner__feature-logo {
            max-height: 1.85rem;
        }
        .tech-performance-banner__brand {
            font-size: 1rem;
        }
        .tech-performance-banner__feature-title {
            min-height: auto;
            margin-bottom: 0.25rem;
            font-size: 0.78rem;
            line-height: 1.4;
        }
        .tech-performance-banner__feature-text {
            font-size: 0.84rem;
            line-height: 1.55;
            color: #64748b;
        }
        .tech-performance-banner__cta {
            width: 100%;
            justify-content: space-between;
            align-self: stretch;
            margin-top: 1.2rem;
            padding: 0.78rem 0.85rem 0.78rem 1.1rem;
            font-size: 0.72rem;
            box-sizing: border-box;
        }
        .tech-performance-banner__note {
            max-width: 100%;
            margin-top: 0.75rem;
            font-size: 0.78rem;
            line-height: 1.5;
            color: #64748b;
        }
    }
    .tech-performance-panel {
        background: linear-gradient(135deg, #0f1d4d 0%, #0c1638 100%);
        border-radius: 16px;
        padding: clamp(1.5rem, 3vw, 2.25rem);
        box-shadow: 0 12px 28px rgba(15, 29, 77, 0.18);
    }
    .tech-performance-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
        gap: clamp(1.25rem, 2.5vw, 2rem);
        align-items: center;
    }
    .tech-performance-kicker {
        margin: 0 0 0.5rem;
        color: #f97316;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
    }
    .tech-performance-heading.section-heading {
        margin: 0 0 0.85rem;
    }
    .tech-performance-heading .section-heading__title {
        justify-content: flex-start;
        font-size: clamp(1.35rem, 2.2vw, 2rem);
    }
    .tech-performance-text {
        margin: 0 0 1rem;
        color: rgba(255, 255, 255, 0.88);
        font-size: clamp(0.88rem, 1vw, 0.98rem);
        line-height: 1.55;
    }
    .tech-performance-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .tech-performance-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        margin-bottom: 0.5rem;
        color: #fff;
        font-size: clamp(0.86rem, 0.95vw, 0.95rem);
        font-weight: 600;
        line-height: 1.4;
    }
    .tech-performance-list li:last-child {
        margin-bottom: 0;
    }
    .tech-performance-list i {
        color: #f97316;
        font-size: 1rem;
        line-height: 1.35;
        flex-shrink: 0;
    }
    .tech-performance-media {
        border-radius: 12px;
        overflow: hidden;
        background: #0a1028;
        line-height: 0;
    }
    .tech-performance-media iframe {
        display: block;
        width: 100%;
        aspect-ratio: 16 / 9;
        border: 0;
    }
    .about-content-card {
        background: #fff;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        padding: 1.35rem 1.4rem;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }
    .about-kicker {
        margin: 0 0 0.45rem;
        color: #f97316;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
    }
    .about-highlight-section > .container > .section-heading {
        margin-bottom: 1.25rem;
    }
    .about-content-card p {
        color: #475569;
        margin-bottom: 0.6rem;
        font-size: clamp(0.88rem, 0.95vw, 0.96rem);
        line-height: 1.55;
    }
    .about-content-card p:last-of-type {
        margin-bottom: 0;
    }
    .about-check-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0;
    }
    .about-check-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        margin-bottom: 0.5rem;
        color: #0f172a;
        font-weight: 600;
        font-size: clamp(0.86rem, 0.95vw, 0.95rem);
        line-height: 1.4;
    }
    .about-check-list li:last-child {
        margin-bottom: 0;
    }
    .about-check-list i {
        color: #f97316;
        font-size: 1rem;
        line-height: 1.35;
        flex-shrink: 0;
    }
    .about-benefits-card {
        background: #fff;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }
    .about-benefit-item {
        display: flex;
        gap: 0.85rem;
        padding: 1rem 1.1rem;
        border-bottom: 1px solid #eef2f7;
    }
    .about-benefit-item:last-child {
        border-bottom: none;
    }
    .about-benefit-item i {
        color: #f97316;
        font-size: 1.45rem;
        line-height: 1;
        margin-top: 0.12rem;
        flex-shrink: 0;
    }
    .about-benefit-item h4 {
        margin: 0 0 0.2rem;
        color: #0f172a;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.25;
    }
    .about-benefit-item p {
        margin: 0;
        color: #64748b;
        font-size: 0.88rem;
        line-height: 1.45;
    }
    .contact-highlight-section {
        background: #fff;
        padding: 1rem 0 2.2rem;
    }
    .contact-highlight-top {
        background: #f97316;
        border-radius: 14px;
        padding: 1.15rem 1.4rem;
        color: #fff;
    }
    .contact-highlight-main {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 1.2rem;
        align-items: center;
    }
    .contact-highlight-icon {
        font-size: 3.2rem;
        line-height: 1;
        flex-shrink: 0;
        opacity: 0.95;
    }
    .contact-highlight-title {
        margin: 0;
        font-size: clamp(1.2rem, 1.7vw, 1.7rem);
        font-weight: 900;
        line-height: 1.2;
    }
    .contact-highlight-text {
        margin: 0.3rem 0 0;
        font-size: clamp(0.88rem, 1.05vw, 1rem);
        font-weight: 400;
        line-height: 1.45;
        opacity: 0.92;
    }
    .contact-highlight-actions {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
        align-items: flex-end;
    }
    .contact-highlight-btns-row {
        display: flex;
        gap: 0.6rem;
    }
    .contact-highlight-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 900;
        font-size: 0.88rem;
        letter-spacing: 0.5px;
        border-radius: 8px;
        padding: 0.8rem 1.2rem;
        white-space: nowrap;
        border: 2px solid transparent;
        transition: all 0.18s ease;
    }
    .contact-highlight-btn.quote {
        background: #fff;
        color: #ea580c;
    }
    .contact-highlight-btn.quote:hover {
        background: #fff7ed;
        color: #c2410c;
    }
    .contact-highlight-btn.whatsapp {
        background: #22c55e;
        color: #fff;
    }
    .contact-highlight-btn.whatsapp:hover {
        background: #16a34a;
        color: #fff;
    }
    .contact-highlight-meta {
        margin-top: 0;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        color: rgba(255,255,255,0.82);
        font-size: 0.82rem;
        font-weight: 500;
        justify-content: flex-end;
    }
    .contact-highlight-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .contact-highlight-bottom {
        margin-top: 1.2rem;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 0;
    }
    .contact-benefit {
        padding: 1.25rem 1.1rem 1.25rem 1rem;
        display: flex;
        gap: 0.85rem;
        border-right: 1px solid #e5e7eb;
        align-items: flex-start;
    }
    .contact-benefit:last-child {
        border-right: none;
    }
    .contact-benefit i {
        color: #1e3a8a;
        font-size: 2.2rem;
        line-height: 1;
        margin-top: 0.05rem;
        flex-shrink: 0;
    }
    .contact-benefit h4 {
        margin: 0;
        color: #0f172a;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.25;
    }
    .contact-benefit p {
        margin: 0.3rem 0 0;
        color: #64748b;
        font-size: 1rem;
    }
    .trust-partners-section {
        background: #f8fafc;
        padding: 0 0 2rem;
    }
    .trust-partners-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }
    .trust-partners-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        background: #fff;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        padding: 1.35rem 1.5rem;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);
        min-height: 115px;
    }
    .trust-partners-content {
        flex: 1 1 auto;
        min-width: 0;
        max-width: 52%;
    }
    .trust-partners-card .section-heading {
        margin-bottom: 0;
        text-align: left;
    }
    .trust-partners-heading {
        margin: 0;
        color: #0f172a;
        font-family: "Rubik", sans-serif;
        font-size: clamp(0.95rem, 1.15vw, 1.1rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: 0.02em;
    }
    .trust-partners-text {
        margin: 0.45rem 0 0;
        color: #64748b;
        font-size: clamp(0.72rem, 0.9vw, 0.82rem);
        line-height: 1.45;
        font-weight: 500;
    }
    .trust-partners-logos {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: clamp(0.75rem, 1.5vw, 1.25rem);
        flex-shrink: 0;
    }
    .trust-partners-logo-slot {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 52px;
        flex-shrink: 0;
    }
    .trust-partners-logo-slot img {
        width: 100%;
        height: 100%;
        max-width: 120px;
        max-height: 52px;
        object-fit: contain;
        object-position: center;
        display: block;
    }
    .trust-partners-card--partners {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    .trust-partners-card--partners .trust-partners-content {
        max-width: none;
    }
    .trust-partners-card--partners .trust-partners-logos {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
        gap: clamp(0.85rem, 2vw, 1.5rem);
    }
    .testimonials-showcase {
        background: #f8fafc;
        padding: 2.2rem 0 2.7rem;
    }
    .testimonials-showcase .section-heading {
        margin-bottom: 1.4rem;
    }
    .testimonials-showcase .section-heading__subtitle {
        max-width: 780px;
        margin-left: auto;
        margin-right: auto;
        font-size: clamp(0.95rem, 1.2vw, 1.25rem);
    }
    .testimonials-showcase-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 0.9rem;
    }
    .testimonial-showcase-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .testimonial-showcase-content {
        padding: 1rem 1rem 0.9rem;
        border-bottom: 1px solid #eef2f7;
    }
    .testimonial-showcase-quote {
        color: #f97316;
        font-size: 2rem;
        line-height: 1;
        font-weight: 900;
        margin-bottom: 0.35rem;
    }
    .testimonial-showcase-stars {
        color: #f59e0b;
        letter-spacing: 1px;
        font-size: 0.95rem;
        margin-bottom: 0.55rem;
    }
    .testimonial-showcase-text {
        margin: 0;
        color: #0f172a;
        font-size: 0.95rem;
        line-height: 1.55;
    }
    .testimonial-showcase-author {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        padding: 0.9rem 1rem 1rem;
    }
    .testimonial-showcase-logo {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 900;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .testimonial-showcase-logo.logo-1 { background: #1e3a8a; }
    .testimonial-showcase-logo.logo-2 { background: #0f766e; }
    .testimonial-showcase-logo.logo-3 { background: #1d4ed8; }
    .testimonial-showcase-logo.logo-4 { background: #dc2626; }
    .testimonial-showcase-name {
        margin: 0;
        color: #0f172a;
        font-size: 1rem;
        font-weight: 800;
    }
    .testimonial-showcase-role,
    .testimonial-showcase-company {
        margin: 0;
        color: #64748b;
        font-size: 0.85rem;
        line-height: 1.35;
    }
    .custom-brand-banner {
        position: relative;
        width: 100%;
        margin: 1.5rem 0 0;
        overflow: hidden;
        border-radius: 12px;
    }
    .custom-brand-banner img {
        width: 100%;
        height: 270px;
        object-fit: cover;
        object-position: right center;
        display: block;
    }
    .custom-brand-banner-content {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        gap: 0.65rem;
        padding: 0 1.25rem clamp(3.7rem, 16%, 5rem);
        left: clamp(0.25rem, 3.2vw, 3.4rem);
        max-width: min(60%, 38rem);
        z-index: 1;
    }
    .custom-brand-banner-title {
        margin: 0;
        font-family: "Rubik", sans-serif;
        font-size: clamp(1.5rem, 3vw, 2.35rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.05;
        color: #fff;
    }
    .custom-brand-banner-title-line {
        display: block;
    }
    .custom-brand-banner-title-accent {
        color: #f97316;
    }
    .custom-brand-cta {
        display: inline-block;
        background: #f97316;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.68rem 1.2rem;
        font-weight: 700;
        font-size: clamp(0.72rem, 1.2vw, 0.9rem);
        text-transform: uppercase;
        letter-spacing: 0.35px;
        text-decoration: none;
        line-height: 1.2;
        box-shadow: 0 6px 16px rgba(249, 115, 22, 0.32);
        transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }
    .custom-brand-cta:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(234, 88, 12, 0.36);
    }
    .custom-brand-cta:focus-visible {
        outline: 3px solid rgba(249, 115, 22, 0.35);
        outline-offset: 2px;
    }
    .featured-banner-fullbleed {
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
    }
    #header-carousel .carousel-item.hero-single-slide {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        height: clamp(520px, 42vw, 680px);
        min-height: 520px;
        background-image:
            linear-gradient(to right, rgba(0, 0, 0, 0.42) 0%, rgba(0, 0, 0, 0.24) 42%, rgba(0, 0, 0, 0.08) 62%, transparent 78%),
            -webkit-image-set(
                url("{{ asset('img/slide_show/slide001.webp') }}") 1x,
                url("{{ asset('img/slide_show/slide001-1920.jpg') }}") 1x
            );
        background-image:
            linear-gradient(to right, rgba(0, 0, 0, 0.42) 0%, rgba(0, 0, 0, 0.24) 42%, rgba(0, 0, 0, 0.08) 62%, transparent 78%),
            image-set(
                url("{{ asset('img/slide_show/slide001.webp') }}") type("image/webp"),
                url("{{ asset('img/slide_show/slide001-1920.jpg') }}") type("image/jpeg")
            );
        background-size: cover;
        background-position: center right;
        background-repeat: no-repeat;
    }
    .hero-slide-inner {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        flex: 1;
        width: 100%;
        min-height: 100%;
        max-width: min(920px, 58vw);
        padding: clamp(2rem, 5vw, 3.5rem) clamp(1.25rem, 6vw, 6rem);
        padding-bottom: clamp(2.75rem, 5.5vh, 4.25rem);
    }
    .hero-slide-title {
        margin: 0;
        font-family: "Rubik", sans-serif;
        font-weight: 700;
        font-size: clamp(1.65rem, 3.8vw, 3.35rem);
        line-height: 1.08;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }
    .hero-slide-title .line-white {
        display: block;
        color: #fff;
        white-space: nowrap;
    }
    .hero-slide-title .line-accent {
        display: block;
        color: #f97316;
        white-space: nowrap;
    }
    .hero-slide-subtitle {
        margin: clamp(0.85rem, 1.6vw, 1.25rem) 0 0;
        color: #fff;
        font-size: clamp(0.92rem, 1.35vw, 1.2rem);
        font-weight: 500;
        line-height: 1.45;
        max-width: 34rem;
    }
    .hero-slide-features {
        display: flex;
        flex-wrap: nowrap;
        gap: 0;
        margin: 0;
        padding: 0;
        list-style: none;
        align-items: stretch;
    }
    .hero-slide-features li {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        flex: 0 0 auto;
        color: #fff;
        font-size: clamp(0.84rem, 1.12vw, 1.05rem);
        font-weight: 600;
        padding: 0 clamp(0.75rem, 1.8vw, 1.5rem);
        border-right: 1px solid rgba(255, 255, 255, 0.25);
    }
    .hero-slide-features li:first-child {
        padding-left: 0;
    }
    .hero-slide-features li:last-child {
        border-right: none;
    }
    .hero-slide-features i {
        color: #f97316;
        font-size: 1.35em;
        flex-shrink: 0;
        line-height: 1;
    }
    .hero-slide-feature-text {
        display: block;
        line-height: 1.2;
    }
    .hero-slide-feature-line {
        display: block;
        white-space: nowrap;
        font-weight: 600;
    }
    .hero-slide-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: clamp(1.25rem, 2.5vw, 1.75rem) 0;
    }
    .hero-slide-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: clamp(160px, 22vw, 250px);
        padding: 0.85rem 1.2rem;
        border-radius: 10px;
        border: 1px solid #f97316;
        font-size: clamp(0.85rem, 1.15vw, 1.12rem);
        font-weight: 800;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 0.2px;
        transition: all 0.2s ease;
    }
    .hero-slide-btn i {
        margin-right: 0.55rem;
        font-size: 1.05em;
        line-height: 1;
    }
    .hero-slide-btn.products {
        color: #fff;
        background: #f97316;
        box-shadow: 0 8px 18px rgba(249, 115, 22, 0.35);
    }
    .hero-slide-btn.products:hover {
        background: #ea580c;
        border-color: #ea580c;
        color: #fff;
    }
    .hero-slide-btn.whatsapp {
        color: #fff;
        background: rgba(15, 23, 42, 0.86);
    }
    .hero-slide-btn.whatsapp:hover {
        background: rgba(15, 23, 42, 1);
        color: #fff;
    }
    @media (max-width: 991.98px) {
        .category-explorer {
            padding: 1.5rem 0 1.7rem;
        }
        .category-explorer-grid:not(.owl-loaded),
        .professional-solutions-grid:not(.owl-loaded),
        .best-sellers-grid:not(.owl-loaded) {
            display: block;
        }
        .category-explorer-grid.owl-carousel .category-explorer-card {
            min-height: 100%;
        }
        .professional-solutions-grid.owl-carousel .professional-solution-card-image {
            aspect-ratio: 16 / 9;
        }
        .best-sellers-grid.owl-carousel .best-seller-image {
            max-width: 160px;
        }
        .best-sellers-grid.owl-carousel .best-seller-price {
            font-size: 1.65rem;
        }
        .professional-catalogs-grid {
            grid-template-columns: 1fr;
        }
        .trust-partners-grid {
            grid-template-columns: 1fr;
        }
        .trust-partners-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.15rem 1.2rem;
        }
        .trust-partners-content {
            max-width: 100%;
        }
        .trust-partners-logos {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .best-sellers-header {
            flex-direction: column;
            align-items: center;
            gap: 0.65rem;
            text-align: center;
        }
        .best-sellers-all-link {
            position: static;
            transform: none;
        }
        .about-highlight-grid {
            grid-template-columns: 1fr;
        }
        .tech-performance-grid {
            grid-template-columns: 1fr;
        }
        .contact-highlight-main {
            grid-template-columns: 1fr;
        }
        .contact-highlight-icon {
            display: none;
        }
        .contact-highlight-actions {
            align-items: flex-start;
        }
        .contact-highlight-btns-row {
            flex-direction: column;
            width: 100%;
        }
        .contact-highlight-btn {
            width: 100%;
        }
        .contact-highlight-meta {
            justify-content: flex-start;
        }
        .contact-highlight-bottom {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .contact-benefit {
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }
        .contact-benefit:nth-last-child(-n+2) {
            border-bottom: none;
        }
        .testimonials-showcase-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .custom-brand-banner {
            display: flex;
            flex-direction: column;
            border-radius: 0;
            margin-top: 1rem;
        }
        .custom-brand-banner img {
            height: clamp(170px, 42vw, 220px);
            object-position: right center;
        }
        .custom-brand-banner-content {
            position: static;
            left: auto;
            max-width: 100%;
            width: 100%;
            gap: 0.75rem;
            padding: 1.15rem 1rem 1.25rem;
            background: linear-gradient(135deg, #0f1d4d 0%, #162456 100%);
            align-items: center;
            text-align: center;
        }
        .custom-brand-banner-title {
            text-align: center;
            font-size: clamp(1.15rem, 5.1vw, 1.7rem);
        }
        .custom-brand-cta {
            padding: 0.66rem 1.1rem;
            font-size: clamp(0.68rem, 3vw, 0.8rem);
        }
        #header-carousel .carousel-item.hero-single-slide {
            min-height: 380px;
            height: clamp(380px, 62vw, 520px);
            display: flex;
            flex-direction: column;
        }
        .hero-slide-inner {
            justify-content: flex-end;
            padding-bottom: clamp(2rem, 4vh, 3rem);
        }
        .hero-slide-features {
            flex-wrap: wrap;
            gap: 0.5rem 0;
        }
        .hero-slide-features li {
            padding: 0.25rem clamp(0.5rem, 1.2vw, 1rem);
        }
        .hero-slide-features li:first-child {
            padding-left: 0;
        }
    }
    @media (max-width: 767.98px) {
        #header-carousel .carousel-item.hero-single-slide {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: clamp(520px, 128vw, 600px);
            height: auto;
            background-position: 72% 18%;
        }
        #header-carousel .carousel-item.hero-single-slide::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.05) 0%,
                rgba(0, 0, 0, 0) 30%,
                rgba(11, 28, 62, 0.45) 55%,
                rgba(11, 28, 62, 0.92) 78%,
                rgba(11, 28, 62, 0.98) 100%
            );
            z-index: 1;
            pointer-events: none;
        }
        .hero-slide-inner {
            position: relative;
            left: auto;
            right: auto;
            top: auto;
            bottom: auto;
            z-index: 2;
            width: 100%;
            max-width: none;
            min-height: auto;
            padding: 0 1.35rem 1.65rem;
            display: flex;
            flex-direction: column;
        }
        .hero-slide-title {
            font-size: clamp(1.05rem, 5.5vw, 1.75rem);
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: 0;
            margin-bottom: 0.65rem;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.35);
        }
        .hero-slide-title .line-white,
        .hero-slide-title .line-accent {
            white-space: nowrap;
        }
        .hero-slide-subtitle {
            font-size: clamp(0.92rem, 3.8vw, 1rem);
            line-height: 1.5;
            max-width: 100%;
            margin: 0;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.28);
        }
        .hero-slide-features {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem 0.75rem;
            margin-top: 1.25rem;
        }
        .hero-slide-features li {
            padding: 0;
            border-right: none;
        }
        .hero-slide-actions {
            flex-direction: column;
            gap: 0;
            margin: 1.15rem 0 0;
            width: 100%;
        }
        .hero-slide-btn.products,
        .hero-slide-btn.whatsapp {
            width: 100%;
            height: 58px;
            border-radius: 14px;
            min-width: 0;
            padding: 0 1.2rem;
            font-size: 0.9rem;
            box-sizing: border-box;
        }
        .hero-slide-btn.products {
            margin-bottom: 14px;
            box-shadow: 0 8px 18px rgba(249, 115, 22, 0.35);
        }
        .hero-slide-btn.whatsapp {
            margin-bottom: 0;
            background: rgba(15, 23, 42, 0.75);
            border: 1.5px solid #f97316;
            backdrop-filter: blur(4px);
        }
        .hero-slide-btn.whatsapp:hover {
            background: rgba(15, 23, 42, 0.9);
            border-color: #fb923c;
        }
        .hero-slide-btn.whatsapp i {
            color: #25d366;
        }
    }
    @media (min-width: 992px) {
        .category-explorer-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }
        .professional-solutions-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
        .best-sellers-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }
    }
    @media (max-width: 575.98px) {
        .contact-highlight-bottom {
            grid-template-columns: 1fr;
        }
        .contact-benefit {
            border-bottom: 1px solid #e5e7eb;
        }
        .contact-benefit:last-child {
            border-bottom: none;
        }
        .testimonials-showcase-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<!-- Carousel Start -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active hero-single-slide" role="img" aria-label="Proteção profissional para todos os setores">
                <div class="hero-slide-inner">
                    <h1 class="hero-slide-title">
                        <span class="line-white">Proteção&nbsp;Profissional</span>
                        <span class="line-accent">Para&nbsp;Todos&nbsp;os&nbsp;Setores</span>
                    </h1>
                    <p class="hero-slide-subtitle">
                        Equipamentos certificados, entrega rápida e soluções personalizadas para a sua empresa.
                    </p>
                    <div class="hero-slide-actions">
                        <a href="{{ route('product') }}" class="hero-slide-btn products">
                            <i class="bi bi-bag" aria-hidden="true"></i>
                            Ver Produtos
                        </a>
                        <a href="{{ route('contact') }}" class="hero-slide-btn whatsapp">
                            <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            Falar no WhatsApp
                        </a>
                    </div>
                    <ul class="hero-slide-features" aria-label="Diferenciais">
                        <li>
                            <i class="bi bi-shield-check" aria-hidden="true"></i>
                            <div class="hero-slide-feature-text">
                                <span class="hero-slide-feature-line">Produtos</span>
                                <span class="hero-slide-feature-line">certificados</span>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-truck" aria-hidden="true"></i>
                            <div class="hero-slide-feature-text">
                                <span class="hero-slide-feature-line">Entrega rápida</span>
                                <span class="hero-slide-feature-line">para toda Europa</span>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-lock-fill" aria-hidden="true"></i>
                            <div class="hero-slide-feature-text">
                                <span class="hero-slide-feature-line">Pagamento</span>
                                <span class="hero-slide-feature-line">100% seguro</span>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-headset" aria-hidden="true"></i>
                            <div class="hero-slide-feature-text">
                                <span class="hero-slide-feature-line">Suporte</span>
                                <span class="hero-slide-feature-line">especializado</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<section class="category-explorer">
    <div class="container">
        <x-section-heading
            title="Explore por categoria"
            subtitle="Encontre rapidamente o equipamento ideal para o seu trabalho."
        />
        <div class="category-explorer-grid home-section-carousel" data-carousel-label="Categorias">
            <a href="/categoria/calcados-de-seguranca" class="category-explorer-card">
                <img src="{{ asset('img/categories/calcado.png') }}" alt="Calçado">
                <h4>Calçado</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="/categoria/vestuario" class="category-explorer-card">
                <img src="{{ asset('img/categories/vestuario.png') }}" alt="Vestuário">
                <h4>Vestuário</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="/categoria/protecao-de-cabeca" class="category-explorer-card">
                <img src="{{ asset('img/categories/capacete.png') }}" alt="Capacetes">
                <h4>Capacetes</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="/categoria/luva-de-protecao" class="category-explorer-card">
                <img src="{{ asset('img/categories/luvas.png') }}" alt="Luvas">
                <h4>Luvas</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="/categoria/protecao-auditiva" class="category-explorer-card">
                <img src="{{ asset('img/categories/protecao-auditiva.png') }}" alt="Proteção auditiva">
                <h4>Proteção auditiva</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
        </div>
    </div>
</section>

<section class="professional-catalogs">
    <div class="container">
        <x-section-heading
            title="Catálogos profissionais"
            subtitle="Explore todas as nossas soluções completas para empresas e profissionais."
        />
        <div class="professional-catalogs-grid">
            <a href="#" class="professional-catalog-card professional-catalog-card--base" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/catalogs/catalogo-base.png') }}" alt="Catálogo Base — Feel the comfort">
                <span class="professional-catalog-cta">Ver catálogo Base</span>
            </a>
            <a href="#" class="professional-catalog-card professional-catalog-card--portwest" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/catalogs/catalogo-portwest.png') }}" alt="Catálogo Portwest — Peak Protection">
                <span class="professional-catalog-cta">Ver catálogo Portwest</span>
            </a>
        </div>
    </div>
</section>

<section class="professional-solutions">
    <div class="container">
        <x-section-heading
            title="Soluções em segurança profissional"
            subtitle="Tudo para a sua segurança no trabalho."
        />
        <div class="professional-solutions-grid home-section-carousel" data-carousel-label="Soluções">
            <a href="/categoria/protecao-de-cabeca" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/equipamentos-protecao.png') }}" alt="Equipamentos de proteção">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-shield-check"></i>
                        Equipamentos de Proteção
                    </h3>
                    <p class="professional-solution-card-text">As melhores soluções para segurança no trabalho.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
            <a href="/categoria/calcados-de-seguranca" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/calcado-seguranca.png') }}" alt="Calçado de segurança">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="fas fa-shoe-prints" aria-hidden="true"></i>
                        Calçado de Segurança
                    </h3>
                    <p class="professional-solution-card-text">Conforto e resistência para o dia a dia.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
            <a href="/categoria/vestuario" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/vestuario-trabalho.png') }}" alt="Vestuário de trabalho">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-person-badge"></i>
                        Vestuário de Trabalho
                    </h3>
                    <p class="professional-solution-card-text">Uniformes que unem proteção e desempenho.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
            <a href="/categoria/protecao-anti-queda" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/antiqueda.jpeg') }}" alt="Proteção anti-queda">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-link-45deg"></i>
                        Proteção Anti-Queda
                    </h3>
                    <p class="professional-solution-card-text">Soluções em altura com máxima segurança.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Start -->
@if (!empty($featuredProducts) && $featuredProducts->count())
<section class="best-sellers-section">
    <div class="container">
        <div class="best-sellers-header">
            <x-section-heading
                title="MAIS VENDIDOS"
                subtitle="Os equipamentos preferidos pelos nossos clientes."
                class="mb-0"
            />
            <a href="{{ route('product') }}" class="best-sellers-all-link">Ver todos os produtos <i class="bi bi-arrow-right-short"></i></a>
        </div>
        <div
            class="best-sellers-grid home-section-carousel"
            data-carousel-label="Mais vendidos"
            data-carousel-desktop="true"
            data-carousel-items="5"
            data-carousel-slide-by="1"
        >
            @foreach ($featuredProducts as $fp)
                @php
                    $img = $fp->cover_image_url ?: asset('img/service-1.jpg');
                    $priceText = filled($fp->price)
                        ? '€' . number_format((float) $fp->price, 2, ',', '.')
                        : 'Consulte';
                @endphp
                <div class="best-seller-card">
                    <a href="{{ route('products.show', $fp) }}" class="best-seller-image-link">
                        <img class="best-seller-image" src="{{ $img }}" alt="{{ $fp->title }}">
                    </a>
                    <h3 class="best-seller-title">{{ \Illuminate\Support\Str::limit((string) $fp->title, 45) }}</h3>
                    <div class="best-seller-stars">★★★★★</div>
                    <div class="best-seller-price">{{ $priceText }}</div>
                    <a class="best-seller-btn" href="{{ route('products.show', $fp) }}">Ver produto</a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Featured Products End -->

<section class="custom-brand-section">
    <div class="container">
        <div class="custom-brand-banner wow fadeInUp" data-wow-delay="0.15s">
            <img src="{{ asset('img/home_sections/personalizamos-sua-marca.png') }}" alt="" role="presentation" aria-hidden="true">
            <div class="custom-brand-banner-content">
                <h2 class="custom-brand-banner-title">
                    <span class="custom-brand-banner-title-line">Personalizamos</span>
                    <span class="custom-brand-banner-title-line">Sua <span class="custom-brand-banner-title-accent">Marca</span></span>
                </h2>
                <a href="{{ route('contact') }}" class="custom-brand-cta">Solicite o seu orçamento</a>
            </div>
        </div>
    </div>
</section>

<section class="contact-highlight-section">
    <div class="container">
        <div class="contact-highlight-top">
            <div class="contact-highlight-main">
                <div class="contact-highlight-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div>
                    <h2 class="contact-highlight-title">Precisa de soluções para a sua empresa?</h2>
                    <p class="contact-highlight-text">A nossa equipa está pronta para o ajudar a encontrar<br>o equipamento ideal para o seu negócio.</p>
                </div>
                <div class="contact-highlight-actions">
                    <div class="contact-highlight-btns-row">
                        <a href="{{ route('contact') }}" class="contact-highlight-btn quote">
                            <i class="bi bi-file-earmark-text"></i>
                            Pedir Orçamento
                        </a>
                        <a href="{{ route('contact') }}" class="contact-highlight-btn whatsapp">
                            <i class="bi bi-whatsapp"></i>
                            Falar no WhatsApp
                        </a>
                    </div>
                    <div class="contact-highlight-meta">
                        <span><i class="bi bi-shield-check"></i> Atendimento rápido</span>
                        <span><i class="bi bi-lock"></i> Segurança e confiança</span>
                        <span><i class="bi bi-clock"></i> Resposta imediata</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-highlight-bottom">
            <div class="contact-benefit">
                <i class="bi bi-shield"></i>
                <div>
                    <h4>Foco em qualidade e durabilidade</h4>
                    <p>Trabalhamos com materiais resistentes e certificados.</p>
                </div>
            </div>
            <div class="contact-benefit">
                <i class="bi bi-handshake"></i>
                <div>
                    <h4>Parcerias com fornecedores confiáveis</h4>
                    <p>Selecionamos os melhores produtos e marcas do mercado.</p>
                </div>
            </div>
            <div class="contact-benefit">
                <i class="bi bi-person-check"></i>
                <div>
                    <h4>Atendimento próximo ao cliente</h4>
                    <p>Entendemos a necessidade da sua empresa.</p>
                </div>
            </div>
            <div class="contact-benefit">
                <i class="bi bi-box-seam"></i>
                <div>
                    <h4>Entrega rápida e eficiente</h4>
                    <p>Logística otimizada para mais agilidade nas entregas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Start -->
<section class="about-highlight-section">
    <div class="container">
        <x-section-heading
            title="Compromisso com a segurança e o negócio"
            subtitle="Equipamentos de proteção e vestuário profissional para empresas que valorizam segurança, conforto e desempenho."
        />
        <div class="about-highlight-grid">
            <div class="about-media-card wow fadeInUp" data-wow-delay="0.1s">
                <div class="about-media-wrap">
                    <img src="{{ asset('img/home_sections/sobre-nos-equipe.png') }}" alt="Equipa Essencial Pro com equipamentos de proteção">
                </div>
            </div>
            <div class="about-content-card wow fadeInUp" data-wow-delay="0.2s">
                <p class="about-kicker">Sobre nós</p>
                <p>A Essencial Pro fornece equipamentos de proteção individual e vestuário profissional para empresas que valorizam segurança, conforto e desempenho no dia a dia.</p>
                <p>Trabalhamos com produtos selecionados e soluções adaptadas a diferentes setores, garantindo qualidade, resistência e confiança em cada detalhe.</p>
                <ul class="about-check-list">
                    <li><i class="bi bi-check-circle-fill"></i> Produtos selecionados com padrão profissional</li>
                    <li><i class="bi bi-check-circle-fill"></i> Soluções para diversos setores</li>
                    <li><i class="bi bi-check-circle-fill"></i> Personalização para a sua empresa</li>
                </ul>
            </div>
            <div class="about-benefits-card wow fadeInUp" data-wow-delay="0.3s">
                <div class="about-benefit-item">
                    <i class="bi bi-shield"></i>
                    <div>
                        <h4>Qualidade Profissional</h4>
                        <p>Produtos com padrão de qualidade para máxima proteção.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-truck"></i>
                    <div>
                        <h4>Envio para todo o país</h4>
                        <p>Entregamos com agilidade e segurança em Portugal e Europa.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-headset"></i>
                    <div>
                        <h4>Atendimento Dedicado</h4>
                        <p>Suporte próximo e humanizado para atender à sua necessidade.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-gear"></i>
                    <div>
                        <h4>Soluções Personalizadas</h4>
                        <p>Personalizamos vestuário e EPI com a identidade da sua empresa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features End -->

<section class="tech-performance-section" id="video-institucional" aria-label="Tecnologia e vídeo institucional Essencial Pro">
    <div class="container">
        <div class="tech-performance-panel wow fadeInUp" data-wow-delay="0.1s">
            <div class="tech-performance-grid">
                <div class="tech-performance-content">
                    <p class="tech-performance-kicker">Tecnologia &amp; performance profissional</p>
                    <x-section-heading
                        tag="h2"
                        align="left"
                        :inverse="true"
                        class="tech-performance-heading mb-0"
                        title="Soluções avançadas para profissionais exigentes"
                    />
                    <p class="tech-performance-text">Trabalhamos com marcas líderes internacionais, reconhecidas pela inovação, qualidade e segurança, para oferecer o melhor desempenho no trabalho diário.</p>
                    <ul class="tech-performance-list">
                        <li><i class="bi bi-check-circle-fill"></i> Alta resistência e durabilidade</li>
                        <li><i class="bi bi-check-circle-fill"></i> Materiais certificados</li>
                        <li><i class="bi bi-check-circle-fill"></i> Conforto para uso prolongado</li>
                        <li><i class="bi bi-check-circle-fill"></i> Inovação aplicada ao trabalho diário</li>
                    </ul>
                </div>
                <div class="tech-performance-media">
                    <iframe
                        id="institutionalVideoPlayer"
                        title="Vídeo institucional Essencial Pro"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        loading="lazy"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tech-performance-banner-section wow fadeInUp" data-wow-delay="0.1s" aria-label="Tecnologias em calçado de segurança">
    <div class="container">
        <div class="tech-performance-banner">
            <img
                class="tech-performance-banner__media"
                src="{{ asset('img/home_sections/tecnologia_tennis.jpeg') }}"
                alt="Calçado Base com tecnologias SmellStop, Dry'n Air e i-daptive"
            >
            <div class="tech-performance-banner__content">
                <h2 class="tech-performance-banner__title">
                    <span class="tech-performance-banner__title-main">AS </span><span class="tech-performance-banner__title-accent">TECNOLOGIAS</span>
                </h2>
                <p class="tech-performance-banner__subtitle">
                    Tecnologia revolucionária para cada tipo de calçado fabricado.
                </p>
                <div class="tech-performance-banner__features">
                    <div class="tech-performance-banner__feature">
                        <div class="tech-performance-banner__feature-head">
                            <img
                                class="tech-performance-banner__feature-logo"
                                src="{{ asset('img/imagem-tennis/imagem1.jpeg') }}"
                                alt="i-daptive"
                            >
                        </div>
                        <p class="tech-performance-banner__feature-title">SISTEMA ADAPTATIVO INTELIGENTE</p>
                        <p class="tech-performance-banner__feature-text">
                            Maior equilíbrio, amortecimento e adaptação dinâmica ao movimento.
                        </p>
                    </div>
                    <div class="tech-performance-banner__feature">
                        <div class="tech-performance-banner__feature-head">
                            <span class="tech-performance-banner__brand tech-performance-banner__brand--drynair">
                                Dry'n <span class="accent">Air</span><sup>®</sup>
                            </span>
                        </div>
                        <p class="tech-performance-banner__feature-title">SISTEMA DE PÉ SECO</p>
                        <p class="tech-performance-banner__feature-text">
                            Respirabilidade avançada para maior conforto durante todo o dia.
                        </p>
                    </div>
                    <div class="tech-performance-banner__feature">
                        <div class="tech-performance-banner__feature-head">
                            <span class="tech-performance-banner__brand tech-performance-banner__brand--smellstop">
                                <span class="accent">Smell</span>Stop<sup>®</sup>
                            </span>
                        </div>
                        <p class="tech-performance-banner__feature-title">FORRO ANTI-ODOR</p>
                        <p class="tech-performance-banner__feature-text">
                            Proteção bacteriana permanente para maior higiene e frescura.
                        </p>
                    </div>
                </div>
                <a href="/categoria/calcados-de-seguranca" class="tech-performance-banner__cta">
                    <span>DESCUBRA OUTRAS TECNOLOGIAS</span>
                    <span class="tech-performance-banner__cta-icon" aria-hidden="true">
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
                <p class="tech-performance-banner__note">
                    Clique e conheça todas as tecnologias exclusivas que tornam os nossos calçados únicos.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="trust-partners-section wow fadeInUp" data-wow-delay="0.15s">
    <div class="container">
        <div class="trust-partners-grid">
            <div class="trust-partners-card trust-partners-card--partners">
                <div class="trust-partners-content">
                    <h3 class="trust-partners-heading">Nossos Parceiros</h3>
                </div>
                <div class="trust-partners-logos trust-partners-logos--suppliers">
                    <span class="trust-partners-logo-slot"><img src="{{ asset('img/partners/portwest.jpeg') }}" alt="Portwest"></span>
                    <span class="trust-partners-logo-slot"><img src="{{ asset('img/partners/base.jpeg') }}" alt="Base Protection"></span>
                    <span class="trust-partners-logo-slot"><img src="{{ asset('img/partners/boa.jpeg') }}" alt="BOA"></span>
                </div>
            </div>
            <div class="trust-partners-card">
                <div class="trust-partners-content">
                    <x-section-heading tag="h3" size="sm" align="left" title="Entrega rápida e segura" class="mb-0" />
                    <p class="trust-partners-text">Trabalhamos com a transportadora GLS para garantir que o seu pedido chegue com agilidade e segurança.</p>
                </div>
                <div class="trust-partners-logos trust-partners-logos--delivery">
                    <span class="trust-partners-logo-slot"><img src="{{ asset('img/partners/gls.jpeg') }}" alt="GLS"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Start -->
<!-- <div class="container-fluid bg-dark pt-5 pb-5 mb-5 px-0">
    <div class="text-center mx-auto pt-4 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Nossos Produtos</p>
            <h1 class="display-5 text-white mb-5">Equipamentos de Segurança para Todos os Segmentos</h1>
    </div>
    <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/calcado.jpeg') }}" alt="Calçados de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Calçados de Segurança</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/capacete.jpeg') }}" alt="Capacetes de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Capacetes</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/colete1.jpeg') }}" alt="Coletes de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Coletes</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/luvas.jpeg') }}" alt="Luvas de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Luvas de Proteção</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/mascara.jpeg') }}" alt="Máscaras de proteção respiratória">
            <div class="project-title">
                <h5 class="text-primary mb-0">Máscaras</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/oculos.jpeg') }}" alt="Óculos de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Óculos de Proteção</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/protetor.jpeg') }}" alt="Protetores de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Protetores</h5>
            </div>
        </a>
    </div>
</div> -->
<!-- Project End -->


<!-- Our Products Start 
<div class="container-xxl py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 650px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Nossos Produtos</p>
            <h2 class="display-6 mb-3 text-uppercase" style="letter-spacing: 2px;">NOSSOS PRODUTOS</h2>
            <div class="mx-auto bg-primary" style="width: 90px; height: 3px;"></div>
        </div>

        <div class="row gy-5 gx-4">
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/calcados.png') }}" alt="Calçados">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/calcados.png') }}" alt="Calçados">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Calçados</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Botas e calçados de segurança com conforto, resistência e proteção para o dia a dia.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/equipamentos.png') }}" alt="Equipamentos de Proteção">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/equipamentos.png') }}" alt="Equipamentos de Proteção">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Equipamentos de Proteção</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">EPIs para proteção individual: auditiva, visual, respiratória, anti-queda e mais.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/vestuario.png') }}" alt="Vestuário de Trabalho">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/vestuario.png') }}" alt="Vestuário de Trabalho">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Vestuário de Trabalho</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Roupa profissional para diferentes setores: resistência, conforto e boa apresentação.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/acessorios.jpg') }}" alt="Acessórios">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/acessorios.jpg') }}" alt="Acessórios">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Acessórios</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Complementos essenciais: malas, joelheiras, iluminação, primeiros socorros e outros.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>
Our Products End -->

<section class="testimonials-showcase">
    <div class="container">
        <x-section-heading
            title="O que os nossos clientes dizem"
            subtitle="Empresas de diversos segmentos que confiam na Essencial Pro para proteger o que mais importa: pessoas e resultados."
        />
        <div class="testimonials-showcase-grid">
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">A Essencial Pro atendeu-nos com muita agilidade e profissionalismo. Os equipamentos têm excelente qualidade e a entrega foi super rápida. Recomendo!</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-1">CR</span>
                    <div>
                        <p class="testimonial-showcase-name">Carlos Mendes</p>
                        <p class="testimonial-showcase-role">Gerente de Compras</p>
                        <p class="testimonial-showcase-company">Construtora Realiza</p>
                    </div>
                </div>
            </article>
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">Trabalhamos com a Essencial Pro desde o início da nossa operação. Sempre com atendimento técnico e soluções personalizadas para as nossas necessidades.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-2">VS</span>
                    <div>
                        <p class="testimonial-showcase-name">Juliana Pereira</p>
                        <p class="testimonial-showcase-role">Coordenadora de RH</p>
                        <p class="testimonial-showcase-company">VerdeMais Serviços</p>
                    </div>
                </div>
            </article>
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">Encontrámos na Essencial Pro um parceiro comprometido com a segurança e o bem-estar da nossa equipa. Produtos de qualidade e conformidade garantida.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-3">MI</span>
                    <div>
                        <p class="testimonial-showcase-name">Ricardo Oliveira</p>
                        <p class="testimonial-showcase-role">Diretor Industrial</p>
                        <p class="testimonial-showcase-company">MetalNorte Indústria</p>
                    </div>
                </div>
            </article>
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">Excelente experiência! A equipa percebeu exatamente o que precisávamos e ajudou-nos a encontrar as melhores soluções em EPI para o nosso negócio.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-4">SV</span>
                    <div>
                        <p class="testimonial-showcase-name">Fernanda Costa</p>
                        <p class="testimonial-showcase-role">Administradora</p>
                        <p class="testimonial-showcase-company">Clínica Saúde & Vida</p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>


{{-- Service section moved to top (below carousel) --}}




@endsection

@push('scripts')
<script>
(function () {
    var mobileCarouselBreakpoint = 992;
    var resizeTimer = null;

    function initHomeSectionCarousels() {
        if (typeof jQuery === 'undefined' || !jQuery.fn.owlCarousel) {
            return;
        }

        jQuery('.home-section-carousel').each(function () {
            var $carousel = jQuery(this);
            var isMobile = window.innerWidth < mobileCarouselBreakpoint;
            var desktopCarousel = $carousel.data('carouselDesktop') === true;
            var itemsPerPage = parseInt($carousel.data('carouselItems'), 10) || 5;
            var slideBy = parseInt($carousel.data('carouselSlideBy'), 10) || itemsPerPage;
            var itemCount = $carousel.children('.best-seller-card, .category-explorer-card, .professional-solution-card').length;
            var shouldUseDesktopCarousel = !isMobile && desktopCarousel && itemCount > itemsPerPage;
            var shouldUseMobileCarousel = isMobile;
            var shouldInit = shouldUseMobileCarousel || shouldUseDesktopCarousel;

            if ($carousel.hasClass('owl-loaded')) {
                $carousel.trigger('destroy.owl.carousel');
                $carousel.removeClass('owl-carousel owl-loaded');
            }

            if (!shouldInit) {
                return;
            }

            var config = {
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                smartSpeed: 650,
                dots: true,
                nav: true,
                margin: 14,
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ]
            };

            if (shouldUseDesktopCarousel) {
                config.items = itemsPerPage;
                config.slideBy = slideBy;
                config.loop = false;
                config.rewind = true;
            } else {
                config.loop = true;
                config.responsive = {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    }
                };
            }

            $carousel.addClass('owl-carousel').owlCarousel(config);
        });
    }

    jQuery(document).ready(function () {
        initHomeSectionCarousels();

        jQuery(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(initHomeSectionCarousels, 180);
        });
    });
})();

(function () {
    var section = document.getElementById('video-institucional');
    var player = document.getElementById('institutionalVideoPlayer');
    if (!section || !player || !('IntersectionObserver' in window)) {
        return;
    }

    var embedBase = 'https://www.youtube.com/embed/WAkl88qoO38';
    var embedParams = 'autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1';
    var isPlaying = false;

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                if (!isPlaying) {
                    player.src = embedBase + '?' + embedParams;
                    isPlaying = true;
                }
            } else if (isPlaying) {
                player.src = '';
                isPlaying = false;
            }
        });
    }, { threshold: 0.45 });

    observer.observe(section);
})();
</script>
@endpush

