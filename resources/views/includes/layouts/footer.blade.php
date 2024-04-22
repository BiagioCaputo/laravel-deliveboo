<footer>
        <img src="/img/footer-wave-desktop.svg" alt="footer-wave">
        <div class="bg-footer">
            <div class="container">

                <div class="logo">
                    <h1 class="logo-text">DeliveBoo
                        <img src="/img/glovo_logo.png" alt="Logo" class="logo-img">
                    </h1>
                </div>
                <div class="d-flex justify-content-between py-5 text-center list-container">
                    <div v-for="(links, i) in store.footerLinks" :key="i" class="text-white">
                        <div>

                            <h4 class="link-title mb-4"></h4>
                            <ul>
                                <a href="#">
                                    <li v-for="(link, i) in links.links" key="i" class="mb-4">
                                      
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <ul class="text-white text-center">
                        <a href="#">
                            <li class="mb-4">
                                <div class="download">
                                    <i class="fa-brands fa-apple fa-xl"></i>
                                    Scarica per apple (da finire)
                                </div>
                            </li>
                        </a>
                        <a href="#">
                            <li class="mb-4">
                                <div class="download">
                                    <i class="fa-brands fa-google-play fa-xl"></i>
                                    Scarica da google play(da finire)
                                </div>
                            </li>
                        </a>
                        <a href="#">
                            <li class="mb-4">TERMINI E CONDIZIONI</li>
                        </a>
                        <a href="#">
                            <li class="mb-4">POLITICA SULLA PRIVACY</li>
                        </a>
                        <a href="#">
                            <li class="mb-4">POLITICA SUI COOKIE</li>
                        </a>
                        <a href="#">
                            <li class="mb-4">CONFORMITÀ</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </footer>