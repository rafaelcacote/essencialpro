@extends('layouts.app')

@section('title', 'Essencial Pro - Equipamentos de Segurança do Trabalho')

@push('styles')
<style>
    .category-explorer {
        background: #f8fafc;
        padding: 2rem 0 2.25rem;
    }
    .category-explorer-header {
        text-align: center;
        margin-bottom: 1rem;
    }
    .category-explorer-title {
        margin: 0;
        color: #0f172a;
        font-size: clamp(1.15rem, 2vw, 2rem);
        font-weight: 800;
        text-transform: uppercase;
    }
    .category-explorer-subtitle {
        margin: 0.35rem 0 0;
        color: #64748b;
        font-size: clamp(0.82rem, 1vw, 0.95rem);
    }
    .category-explorer-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 0.85rem;
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
    .professional-solutions {
        background: #f8fafc;
        padding: 0.3rem 0 2.4rem;
    }
    .professional-solutions-header {
        text-align: center;
        margin-bottom: 1.15rem;
    }
    .professional-solutions-header h2 {
        margin: 0;
        color: #0f1d4d;
        font-size: clamp(1.2rem, 2.1vw, 2.25rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .professional-solutions-header p {
        margin: 0.35rem 0 0;
        color: #64748b;
        font-size: clamp(0.82rem, 1.05vw, 1rem);
        font-weight: 600;
    }
    .professional-solutions-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
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
    .best-sellers-title {
        margin: 0;
        color: #0f1d4d;
        font-size: clamp(1.2rem, 2vw, 2rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.4px;
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
        padding: 2.2rem 0 2.6rem;
        background: #f8fafc;
    }
    .about-highlight-grid {
        display: grid;
        grid-template-columns: 1.08fr 1fr 0.92fr;
        gap: 1rem;
        align-items: stretch;
    }
    .about-media-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
    }
    .about-media-wrap {
        position: relative;
        background: #0f172a;
    }
    .about-media-wrap img {
        width: 100%;
        aspect-ratio: 16 / 11;
        object-fit: cover;
        display: block;
    }
    .about-video-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 88px;
        height: 88px;
        border: 4px solid #fff;
        border-radius: 50%;
        background: rgba(15, 23, 42, 0.3);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }
    .about-video-play i {
        font-size: 2.1rem;
        margin-left: 4px;
    }
    .about-video-play:hover {
        transform: translate(-50%, -50%) scale(1.04);
        background: rgba(15, 23, 42, 0.5);
        color: #fff;
    }
    .about-video-controls {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0.75rem 0.85rem 0.7rem;
        background: linear-gradient(to top, rgba(2, 6, 23, 0.88) 0%, rgba(2, 6, 23, 0.25) 70%, rgba(2, 6, 23, 0) 100%);
        z-index: 2;
    }
    .about-video-progress {
        width: 100%;
        height: 5px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.28);
        margin-bottom: 0.55rem;
        overflow: hidden;
    }
    .about-video-progress span {
        display: block;
        width: 22%;
        height: 100%;
        background: #f97316;
    }
    .about-video-controls-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .about-video-controls-left,
    .about-video-controls-right {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
    }
    .about-video-controls i {
        line-height: 1;
        font-size: 1rem;
    }
    .about-content-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.2rem 1.3rem;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
    }
    .about-kicker {
        margin: 0 0 0.4rem;
        color: #f97316;
        font-size: 0.9rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .about-main-title {
        margin: 0 0 0.8rem;
        color: #0f1d4d;
        font-size: clamp(1.2rem, 2vw, 2rem);
        line-height: 1.2;
        font-weight: 900;
    }
    .about-content-card p {
        color: #334155;
        margin-bottom: 0.55rem;
    }
    .about-check-list {
        list-style: none;
        padding: 0;
        margin: 0.8rem 0 1rem;
    }
    .about-check-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        margin-bottom: 0.45rem;
        color: #0f172a;
        font-weight: 600;
    }
    .about-check-list i {
        color: #f97316;
        font-size: 1rem;
        line-height: 1.4;
    }
    .about-cta-btn {
        display: inline-block;
        background: #f97316;
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 800;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        letter-spacing: 0.35px;
    }
    .about-cta-btn:hover {
        color: #fff;
        background: #ea580c;
    }
    .about-benefits-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
    }
    .about-benefit-item {
        display: flex;
        gap: 0.8rem;
        padding: 1rem 1.05rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .about-benefit-item:last-child {
        border-bottom: none;
    }
    .about-benefit-item i {
        color: #f97316;
        font-size: 1.5rem;
        line-height: 1;
        margin-top: 0.1rem;
    }
    .about-benefit-item h4 {
        margin: 0 0 0.2rem;
        color: #0f172a;
        font-size: 1.1rem;
        font-weight: 800;
    }
    .about-benefit-item p {
        margin: 0;
        color: #334155;
        font-size: 0.95rem;
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
    .technologies-banner-section {
        background: #fff;
        padding: 0.25rem 0 1.5rem;
    }
    .technologies-banner-section img {
        width: 100%;
        border-radius: 10px;
        display: block;
    }
    .testimonials-showcase {
        background: #f8fafc;
        padding: 2.2rem 0 2.7rem;
    }
    .testimonials-showcase-header {
        text-align: center;
        margin-bottom: 1.4rem;
    }
    .testimonials-showcase-kicker {
        margin: 0;
        color: #f97316;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 0.6px;
        font-size: 0.85rem;
    }
    .testimonials-showcase-title {
        margin: 0.3rem 0 0.35rem;
        color: #0f172a;
        font-size: clamp(1.45rem, 2.8vw, 3rem);
        font-weight: 900;
        line-height: 1.12;
    }
    .testimonials-showcase-subtitle {
        margin: 0 auto;
        color: #64748b;
        max-width: 780px;
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
        width: 100%;
        margin: 1.5rem 0 0;
        text-align: center;
        position: relative;
    }
    .custom-brand-banner img {
        width: 100%;
        height: auto;
        display: block;
    }
    .custom-brand-cta {
        position: absolute;
        left: clamp(4rem, 12vw, 10rem);
        bottom: clamp(5rem, 12.8vw, 10.4rem);
        display: inline-block;
        margin-top: 0;
        background: #f97316;
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.95rem 2.2rem;
        font-weight: 800;
        font-size: clamp(0.95rem, 1.15vw, 1.1rem);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-decoration: none;
        box-shadow: 0 10px 22px rgba(249, 115, 22, 0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        z-index: 2;
    }
    .custom-brand-cta:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(234, 88, 12, 0.38);
    }
    .custom-brand-cta:focus-visible {
        outline: 3px solid rgba(249, 115, 22, 0.3);
        outline-offset: 2px;
    }
    .featured-banner-fullbleed {
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
    }
    .partners-section {
        background: #f8fafc;
    }
    .partners-section .partners-section-inner {
        padding: clamp(2.25rem, 4vw, 3.5rem) 0;
    }
    .partners-section .partners-strip {
        background: #fff;
        border-radius: 14px;
        padding: clamp(0.6rem, 1.2vw, 1rem);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }
    .hero-single-slide {
        position: relative;
    }
    .hero-slide-actions {
        position: absolute;
        left: clamp(3.0rem, 9.0vw, 6.0rem);
        bottom: clamp(5.4rem, 13.4vw, 9.4rem);
        z-index: 2;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
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
        .category-explorer-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .professional-solutions-grid {
            grid-template-columns: 1fr;
        }
        .best-sellers-header {
            justify-content: space-between;
        }
        .best-sellers-all-link {
            position: static;
            transform: none;
        }
        .best-sellers-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .about-highlight-grid {
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
        .custom-brand-cta {
            left: 1rem;
            bottom: 1rem;
            font-size: 0.82rem;
            padding: 0.7rem 1.25rem;
        }
        .hero-slide-actions {
            left: 1rem;
            right: 0.75rem;
            bottom: 1.35rem;
            gap: 0.6rem;
        }
        .hero-slide-btn {
            flex: 1 1 100%;
            min-width: 0;
            font-size: 0.82rem;
            padding: 0.72rem 0.95rem;
        }
    }
    @media (max-width: 575.98px) {
        .category-explorer-grid {
            grid-template-columns: 1fr;
        }
        .best-sellers-grid {
            grid-template-columns: 1fr;
        }
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
            <div class="carousel-item active hero-single-slide">
                <img class="w-100" src="{{ asset('img/slide_show/slide001.jpeg') }}" alt="Protecao Profissional para todos os setores">
                <div class="hero-slide-actions">
                    <a href="{{ route('product') }}" class="hero-slide-btn products">
                        <i class="bi bi-bag"></i>
                        Ver Produtos
                    </a>
                    <a href="{{ route('contact') }}" class="hero-slide-btn whatsapp">
                        <i class="bi bi-whatsapp"></i>
                        Falar no Whatsap
                    </a>
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
        <div class="category-explorer-header">
            <h2 class="category-explorer-title">Explore por categoria</h2>
            <p class="category-explorer-subtitle">Encontre rapidamente o equipamento ideal para o seu trabalho.</p>
        </div>
        <div class="category-explorer-grid">
            <a href="/categoria/calcados-de-seguranca" class="category-explorer-card">
                <img src="{{ asset('img/categories/calcado.png') }}" alt="Calcado">
                <h4>Calcado</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="/categoria/vestuario" class="category-explorer-card">
                <img src="{{ asset('img/categories/vestuario.png') }}" alt="Vestuario">
                <h4>Vestuario</h4>
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
                <img src="{{ asset('img/categories/protecao-auditiva.png') }}" alt="Protecao auditiva">
                <h4>Protecao Auditiva</h4>
                <span>Ver produtos <i class="bi bi-arrow-right-short"></i></span>
            </a>
        </div>
    </div>
</section>

<section class="professional-solutions">
    <div class="container">
        <div class="professional-solutions-header">
            <h2>Solucoes em seguranca profissional</h2>
            <p>Tudo para a sua seguranca no trabalho.</p>
        </div>
        <div class="professional-solutions-grid">
            <a href="/categoria/protecao-de-cabeca" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/equipamentos-protecao.png') }}" alt="Equipamentos de protecao">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-shield-check"></i>
                        Equipamentos de Protecao
                    </h3>
                    <p class="professional-solution-card-text">As melhores solucoes para seguranca no trabalho.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
            <a href="/categoria/calcados-de-seguranca" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/calcado-seguranca.png') }}" alt="Calcado de seguranca">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-boot"></i>
                        Calcado de Seguranca
                    </h3>
                    <p class="professional-solution-card-text">Conforto e resistencia para o dia a dia.</p>
                    <span class="professional-solution-card-cta">Ver produtos <i class="bi bi-arrow-right-short"></i></span>
                </div>
            </a>
            <a href="/categoria/vestuario" class="professional-solution-card">
                <img class="professional-solution-card-image" src="{{ asset('img/solutions/vestuario-trabalho.png') }}" alt="Vestuario de trabalho">
                <div class="professional-solution-card-body">
                    <h3 class="professional-solution-card-title">
                        <i class="bi bi-person-badge"></i>
                        Vestuario de Trabalho
                    </h3>
                    <p class="professional-solution-card-text">Uniformes que unem protecao e desempenho.</p>
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
            <h2 class="best-sellers-title">Mais vendidos</h2>
            <a href="{{ route('product') }}" class="best-sellers-all-link">Ver todos os produtos <i class="bi bi-arrow-right-short"></i></a>
        </div>
        <div class="best-sellers-grid">
            @foreach ($featuredProducts->take(5) as $fp)
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
    <div class="custom-brand-banner wow fadeInUp" data-wow-delay="0.15s">
        <img src="{{ asset('img/home_sections/personalizamos-sua-marca-novo.png') }}" alt="Personalizamos sua marca">
        <a href="{{ route('contact') }}" class="custom-brand-cta">Solicite o seu orcamento</a>
    </div>
</section>
@endif
<!-- Featured Products End -->


<!-- Features Start -->
<section class="about-highlight-section">
    <div class="container">
        <div class="about-highlight-grid">
            <div class="about-media-card wow fadeInUp" data-wow-delay="0.1s">
                <div class="about-media-wrap">
                    <img src="{{ asset('img/feature.jpg') }}" alt="Sobre a Essencial Pro">
                    <button type="button" class="about-video-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/WAkl88qoO38" data-bs-target="#videoModal">
                        <i class="bi bi-play-fill"></i>
                    </button>
                    <div class="about-video-controls" aria-hidden="true">
                        <div class="about-video-progress"><span></span></div>
                        <div class="about-video-controls-row">
                            <div class="about-video-controls-left">
                                <i class="bi bi-play-fill"></i>
                                <span>0:00 / 1:15</span>
                            </div>
                            <div class="about-video-controls-right">
                                <i class="bi bi-volume-up-fill"></i>
                                <i class="bi bi-fullscreen"></i>
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-content-card wow fadeInUp" data-wow-delay="0.2s">
                <p class="about-kicker">Sobre nos</p>
                <h2 class="about-main-title">Compromisso com a seguranca e o seu negocio</h2>
                <p>A Essencial Pro fornece equipamentos de protecao individual e vestuario profissional para empresas que valorizam seguranca, conforto e desempenho no dia a dia.</p>
                <p>Trabalhamos com produtos selecionados e solucoes adaptadas a diferentes setores, garantindo qualidade, resistencia e confianca em cada detalhe.</p>
                <ul class="about-check-list">
                    <li><i class="bi bi-check-circle-fill"></i> Produtos selecionados com padrao profissional</li>
                    <li><i class="bi bi-check-circle-fill"></i> Solucoes para diversos setores</li>
                    <li><i class="bi bi-check-circle-fill"></i> Personalizacao para sua empresa</li>
                </ul>
                <a href="{{ route('about') }}" class="about-cta-btn">Conhecer mais</a>
            </div>
            <div class="about-benefits-card wow fadeInUp" data-wow-delay="0.3s">
                <div class="about-benefit-item">
                    <i class="bi bi-award"></i>
                    <div>
                        <h4>Qualidade Profissional</h4>
                        <p>Produtos com padrao de qualidade para maxima protecao.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-truck"></i>
                    <div>
                        <h4>Envio para todo o pais</h4>
                        <p>Entregamos com agilidade e seguranca em Portugal e Europa.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-headset"></i>
                    <div>
                        <h4>Atendimento Dedicado</h4>
                        <p>Suporte proximo e humanizado para atender sua necessidade.</p>
                    </div>
                </div>
                <div class="about-benefit-item">
                    <i class="bi bi-gear"></i>
                    <div>
                        <h4>Solucoes Personalizadas</h4>
                        <p>Personalizamos vestuario e EPI com a identidade da sua empresa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features End -->

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

    

<!-- Products Partners Start -->
<section class="contact-highlight-section">
    <div class="container">
        <div class="contact-highlight-top">
            <div class="contact-highlight-main">
                <div class="contact-highlight-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div>
                    <h2 class="contact-highlight-title">Precisa de soluções para sua empresa?</h2>
                    <p class="contact-highlight-text">Nossa equipe está pronta para ajudar você a encontrar<br>o equipamento ideal para o seu negócio.</p>
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

<section class="technologies-banner-section">
    <div class="container">
        <img src="{{ asset('img/home_sections/tecnologias-banner.png') }}" alt="As tecnologias">
    </div>
</section>

<div class="container-fluid px-0 partners-section">
    <div class="container-xxl partners-section-inner">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Produtos Parceiros</p>
            <h2 class="display-6 mb-0">Produtos Parceiros</h2>
        </div>

        <div class="partners-strip wow fadeInUp" data-wow-delay="0.1s">
            <div class="partners-strip-inner">
                @if (!empty($partners) && $partners->count())
                    @foreach ($partners as $partner)
                        <div class="partner-logo">
                            @if ($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener">
                                    <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}">
                                </a>
                            @else
                                <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}">
                            @endif
                        </div>
                    @endforeach
                @else
                    {{-- Placeholder enquanto não houver cadastros --}}
                    @for ($i = 0; $i < 5; $i++)
                        <div class="partner-logo @if ($i >= 3) d-none d-md-block @endif @if ($i >= 4) d-none d-lg-block @endif">
                            <div class="partner-logo-placeholder">
                                <i class="bi bi-image"></i>
                                <div>Logo</div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- Products Partners End -->

<section class="testimonials-showcase">
    <div class="container">
        <div class="testimonials-showcase-header">
            <p class="testimonials-showcase-kicker">Depoimentos</p>
            <h2 class="testimonials-showcase-title">O que nossos clientes dizem</h2>
            <p class="testimonials-showcase-subtitle">Empresas de diversos segmentos que confiam na Essencial Pro para proteger o que mais importa: pessoas e resultados.</p>
        </div>
        <div class="testimonials-showcase-grid">
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">A Essencial Pro nos atendeu com muita agilidade e profissionalismo. Os equipamentos tem excelente qualidade e a entrega foi super rapida. Recomendo!</p>
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
                    <p class="testimonial-showcase-text">Trabalhamos com a Essencial Pro desde o inicio da nossa operacao. Sempre com atendimento tecnico e solucoes personalizadas para nossas necessidades.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-2">VS</span>
                    <div>
                        <p class="testimonial-showcase-name">Juliana Pereira</p>
                        <p class="testimonial-showcase-role">Coordenadora de RH</p>
                        <p class="testimonial-showcase-company">VerdeMais Servicos</p>
                    </div>
                </div>
            </article>
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">Encontramos na Essencial Pro um parceiro comprometido com a seguranca e o bem-estar da nossa equipe. Produtos de qualidade e conformidade garantida.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-3">MI</span>
                    <div>
                        <p class="testimonial-showcase-name">Ricardo Oliveira</p>
                        <p class="testimonial-showcase-role">Diretor Industrial</p>
                        <p class="testimonial-showcase-company">MetalNorte Industria</p>
                    </div>
                </div>
            </article>
            <article class="testimonial-showcase-card">
                <div class="testimonial-showcase-content">
                    <div class="testimonial-showcase-quote">“</div>
                    <div class="testimonial-showcase-stars">★★★★★</div>
                    <p class="testimonial-showcase-text">Excelente experiencia! A equipe entendeu exatamente o que precisavamos e nos ajudou a encontrar as melhores solucoes em EPI para o nosso negocio.</p>
                </div>
                <div class="testimonial-showcase-author">
                    <span class="testimonial-showcase-logo logo-4">SV</span>
                    <div>
                        <p class="testimonial-showcase-name">Fernanda Costa</p>
                        <p class="testimonial-showcase-role">Administradora</p>
                        <p class="testimonial-showcase-company">Clinica Saude & Vida</p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>


<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


{{-- Service section moved to top (below carousel) --}}




@endsection

