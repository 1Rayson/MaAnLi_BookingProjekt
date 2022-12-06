<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-anders.css">
    <title>Mine Tider</title>
</head>
<body>
    <wrapper class="site-wrapper">
        <section id="header">
            <h1>Studierum booking</h1>
            <hr>
        </section>
        <section id="nav-content">
            <nav id="booking-nav-desktop">
                <div class="nav-item">
                    <div><h3>|</h3></div>
                    <a><h3>Book Lokale</h3></a>
                </div>
                <div class="nav-item active">
                    <div><h3>|</h3></div>
                    <a><h3>Mine Tider</h3></a>
                </div>
                <h2 id="breadcrumb-nav-mobile">Mine Tider</h2>
            </nav>

            <article class="content row-reverse">
                <section id="calendar">
                    <div>TEMPORARY CALENDAR BOX</div> <!-- TEMPORARY BOX -->
                </section>
                <section id="my-bookings">
                    <article id="booking-headers">
                        <h3>Dato</h3>
                        <h3>Tidsrum</h3>
                        <h3>Lokale</h3>
                    </article>
                    <hr>
                    <article id="bookings">
                        <section class="booking">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <p>24/11-22</p>
                                    <p>08:30-12:30</p>
                                    <p>1.16</p>
                                </section>
                                <section class="organizer">
                                    <p>Maanli -  Tværfagligt projekt - gruppe arbejde</p>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <input type="submit" id="update-submit" value="Opdatér">
                                <input type="submit" id="delete-submit" value="Slet">
                            </article>
                        </section>
                        <section class="divider">
                            <hr>
                        </section>
                        <section class="booking">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <p>25/11-22</p>
                                    <p>09:30-14:00</p>
                                    <p>1.40</p>
                                </section>
                                <section class="organizer">
                                    <p>Maanli -  Tværfagligt projekt - gruppe arbejde</p>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <input type="submit" id="update-submit" value="Opdatér">
                                <input type="submit" id="delete-submit" value="Slet">
                            </article>
                        </section>
                    </article>
                    <hr>
                </section>
            </article>
        </section>
    </wrapper>
</body>
</html>