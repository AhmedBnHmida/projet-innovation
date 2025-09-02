<!-- View/components/footer.php -->
</div> <!-- End container -->

<footer class="footer text-white text-center py-3 mt-auto">
    <p>&copy; <?= date('Y') ?> Plateforme d'Innovation. Tous droits réservés. Ahmed Ben hmida</p>
</footer>

<style>
    /* Make footer sticky to bottom */
    body, html {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1; /* Push footer to bottom */
    }

    /* Footer Styling */
    .footer {
        background: linear-gradient(90deg, #1e3c72, #2a5298);
        color: #fff;
        font-weight: 500;
        letter-spacing: 0.5px;
        box-shadow: 0 -2px 6px rgba(0,0,0,0.2);
    }

    .footer p {
        margin: 0;
        font-size: 0.95rem;
    }

    /* Optional hover effect on text */
    .footer p:hover {
        color: #ffc107;
        transition: color 0.3s;
    }
</style>
