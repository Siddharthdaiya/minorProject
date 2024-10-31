     <!-- <?php
     include 'config.php';
    ?>  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Real Estate Website Landing Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="styles.css" type="text/css" rel="Stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/95dc93da07.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
    <div id="header-hero-container">
        <header>
            <div class="flex container">
                <div class="log">
                    <img  src="Images/p__1_-removebg-preview.png"height="65px" width="65px">
                </div>
                <a id="logo" href="#">PRIME PROPERTY</a>
                <nav>
                    <button id="nav-toggle" class="hamburger-menu">
                        <span class="strip"></span>
                        <span class="strip"></span>
                        <span class="strip"></span>
                    </button>

                    <ul id="nav-menu">
                        <li><a href="#" class="active">Home</a></li>
                        <li><a href="properties.php">Properties</a></li>
                        <li><a href="#agents">Agents</a></li>
                        <li><a href="aboutus.html">AboutUs</a></li>
                        <li><a href="calculator.html">Calculator</a></li>
                        <li><a href="#contact">ContactUs</a></li>
                        <li><a href="signup.php">Sign Up</a></li>
                        <li id="close-flyout"><span class="fas fa-times"></span></li>
                    </ul>
                </nav>
            </div>
        </header>

        <section id="hero">
            <div class="fade">
                <div class="image_container">
                    <img src="Images/pexels-alex-staudinger-829197-1732414.jpg" width="1215" height="600px" >
                </div>
            </div>
            <div class="hero-text">
           
                <h1>Buy and sell real estate properties</h1>
                <p>  Homes that fit your lifestyle, perfectly.</p>
            </div>
        </section>
    </div>

    <section id="how-it-works" style="background: rgb(223, 217, 213);">
        <div class="container">
            <h2>How It Works</h2>
            <div class="flex">
                <div> 
                    <span class="fas fa-home"></span>
                    <div class="con">
                        <img src="Images/icons8-property-100.png" height="70px">
                    </div>
                    <a href="properties.php"><button class="rounded">Buy a Property.</button></a>
                    <p style="color: black; margin-top: 15px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ">Invest in your future,buy the home you have always dreamed of</p>
                </div>

                <div>
                    <span class="fas fa-dollar-sign"></span>
                    <div class="con">
                        <img src="Images/deal.png"height="70px" width="70px">
                    </div>
                    <a href="sellpro.php"><button class="rounded">Sell a Property.</button>
                    </a>
                    <p style="color: black; margin-top: 15px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ">Unlock your homes value—get the best offer today.</p>
                </div>

                <div>
                    <span class="fas fa-chart-line"></span>
                    <div class="con">
                        <img src="Images/investment.png"height="70px">
                    </div>
                    <a href="rentalpropt.php"><button class="rounded">Rented Property</button></a>
                    <p style="color: black; margin-top: 15px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ">Turn your money into a growing asset—invest in property.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="properties">
        <div class="container">
            <h2>Properties</h2>
            <div id="properties-slider" class="slick">
                <div class="cardview">
                    <div class="con prop">
                        <img src="Images/property-2.jpg" alt="Property 1" />
                    </div>
                    <div class="property-details">
                        <p class="price">$3,400,000</p>
                        <span class="beds">6 beds</span>
                        <span class="baths">4 baths</span>
                        <span class="sqft">4,250 sqft.</span>
                        <address>
                            480 12th, Unit 14, San Francisco, CA
                        </address>
                    </div>
                </div>
                <div>
                    <div class="con prop">
                        <img src="Images/property-3.jpg" alt="Property 2" />
                    </div>
                    <div class="property-details">
                        <p class="price">$3,400,000</p>
                        <span class="beds">6 beds</span>
                        <span class="baths">4 baths</span>
                        <span class="sqft">4,250 sqft.</span>
                        <address>
                            480 12th, Unit 14, San Francisco, CA
                        </address>
                    </div>
                </div>
                <div>
                    <div class="con prop">
                        <img src="Images/property-4.jpg" alt="Property 3" />
                    </div>
                    <div class="property-details">
                        <p class="price">$3,400,000</p>
                        <span class="beds">6 beds</span>
                        <span class="baths">4 baths</span>
                        <span class="sqft">4,250 sqft.</span>
                        <address>
                            480 12th, Unit 14, San Francisco, CA
                        </address>
                    </div>
                </div>
                <div>
                    <div class="con prop">
                        <img src="Images/property-5.jpg" alt="Property 4" />
                    </div>
                    <div class="property-details">
                        <p class="price">$3,400,000</p>
                        <span class="beds">6 beds</span>
                        <span class="baths">4 baths</span>
                        <span class="sqft">4,250 sqft.</span>
                        <address>
                            480 12th, Unit 14, San Francisco, CA
                        </address>
                    </div>
                </div>

                <div>
                    <div class="con prop">
                        <img src="Images/property-6.jpg" alt="Property 5" />

                    </div>
                        <div class="property-details">
                        <p class="price">$3,400,000</p>
                        <span class="beds">6 beds</span>
                        <span class="baths">4 baths</span>
                        <span class="sqft">4,250 sqft.</span>
                        <address>
                            480 12th, Unit 14, San Francisco, CA
                        </address>
                    </div>
                </div>
            </div>

            <a href="properties.php" style="text-decoration: none;"><button class="rounded">View All Property Listings</button></a>
        </div>
    </section>  

    <section id="agents" style="background: rgb(223, 217, 213);">
        <div class="container">
            <h2>Agents</h2>
            <p class="large-paragraph">Learn more about our trusted agents who make your real estate journey smooth and successful.</p>

            <div class="flex">
                <div class="card">
                    <img src="Images/images.jpg" alt="Realtor 1" />
                    <div class="info">
                        <h3>Kaiara Spencer</h3>
                        <p>Real Estate Agent</p>
                        <a href="#" class="btnn">Read More</a>
                    </div>
                </div>


                <div class="card">
                    <img src="Images/pexels-rdne-7821936.jpg" alt="Realtor 2" />
                    <div class="info">
                        <h3>Stuart Redman</h3>
                        <p>Real Estate Agent</p>
                        <a href="#" class="btnn">Read More</a>

                    </div>
                </div>

                <div class="card">
                    <img src="Images/pexels-pavel-danilyuk-7937670.jpg"alt="Realtor 3" />
                   <div class="info">
                    <h3>Dave Simpson</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                   </div>
                </div>

                <div class="card">
                    <img src="Images/pexels-rdne-10376002.jpg" alt="Realtor 4" />
                   <div class="info">
                    <h3>Ben Thompson</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                   </div>
                </div>

                <div class="card">
                    <img src="Images/pexels-mikhail-nilov-7681297.jpg" alt="Realtor 5" />
                    <div class="info">
                        <h3>Kyla Stewart</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                    </div>
                </div>

                <div class="card">
                    <img src="Images/pexels-rdne-10376002.jpg" alt="Realtor 6" />
                   <div class="info">
                    <h3>Rich Moffatt</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                   </div>
                </div>
                <div class="card">
                    <img src="Images/pexels-rdne-7821936.jpg" alt="Realtor 7" />
                   <div class="info">
                    <h3>Rich Moffatt</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                   </div>
                </div>
                <div class="card">
                    <img src="Images/pexels-olly-864994.jpg" alt="Realtor 8" />
                   <div class="info">
                    <h3>Darshna Hadiya</h3>
                    <p>Real Estate Agent</p>
                    <a href="#" class="btnn">Read More</a>

                   </div>
                </div>

               
            </div>
        </div>

  
    </section>

    <section id="the-best">
        <div class="flex container">
            <img src="Images/carousel-2.jpg" alt="Property 1" />
         
            <div>
                <h2 >We Are the Best Real Estate Company</h2>
                <p class="large-paragraph" style="color: black; font-family:sans-serif">We Provide the best property,According To your need.</p>
                <p style="color: black; font-family:sans-serif">And we have great facilities like....</p>
                <ul>
                    <li style="color: black; font-family:sans-serif">Customer Testimonials: Positive feedback from satisfied clients</li>
                    <li style="color: black; font-family:sans-serif">Comprehensive Property Listings</li>
                    <li style="color: black; font-family:sans-serif">Outdoor Space: Private yard, garden, or balcony for relaxation.</li>
                    <li style="color: black; font-family:sans-serif">Modern Amenities: Equipped with the latest features and conveniences.</li>
                    <li style="color: black; font-family:sans-serif">High-Quality Construction: Built with durable materials and superior craftsmanship.</li>
                </ul>
                <button class="rounded" onclick="window.location.href='aboutus.html'">Learn More</button>

            </div>
        </div>
    </section>

    <section id="services" style="background: rgb(223, 217, 213);">
        <div class="container">
            <h2>Services</h2>
            <div class="flex">
                <div>
                    <div class="fas fa-home"></div>
                    <div class="services-card-right">
                        <h3 style="text-decoration: solid;color:black">Search Property</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>

                <div>
                    <div class="fas fa-dollar-sign"></div>
                    <div class="services-card-right">
                        <h3 style="text-decoration: solid;color:black">Buy Property</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>

                <div>
                    <div class="fas fa-chart-line"></div>
                    <div class="services-card-right">
                        <h3 style="text-decoration: solid;color:black">Rent a Property</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <a href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials">
        <div class="container">
            <h2>What Our Clients Are Saying</h2>
            <div id="testimonials-slider">
                <div>
                    <blockquote>
                        <p>"Finding our dream home seemed daunting, but [Your Real Estate Company Name] made the process smooth and enjoyable. Their team was incredibly knowledgeable about the market and took the time to understand exactly what we were looking for. They guided us through every step, from initial viewings to closing the deal, with professionalism and care. We couldn't be happier with our new home and highly recommend Prime Property to anyone looking for their perfect property"</p>
                    </blockquote>
                    <div class="testimonials-caption">
                        <!-- <img src="" alt="Client 7" /> -->
                        <p>Nick Andros</p>
                    </div>
                </div>

                <div>
                    <blockquote>
                        <p>"Working with Prime Property was a fantastic experience from start to finish. They were patient, attentive, and truly dedicated to finding us a property that met all our needs. Their expertise and local market knowledge were invaluable, and they made what can be a stressful process feel completely manageable. We’re thrilled with our new home and grateful for their support. Highly recommended!."</p>
                    </blockquote>
                    <div class="testimonials-caption">
                        <!-- <img src="https://onclickwebdesign.com/wp-content/uploads/person_5.jpg" alt="Client 7" /> -->
                        <p>Larry Underwood</p>
                    </div>
                </div>

                <div>
                    <blockquote>
                        <p>"We had specific requirements and a tight deadline, but Prime Property delivered beyond our expectations. Their team was incredibly responsive and managed to find us a property that ticked all the boxes within our timeframe. The entire process was seamless, and we couldn’t be more pleased with the outcome. A truly exceptional service!"</p>
                    </blockquote>
                    <div class="testimonials-caption">
                        <!-- <img src="https://onclickwebdesign.com/wp-content/uploads/person_8.jpg" alt="Client 7" /> -->
                        <p>Fran Goldsmith</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" style="background: rgb(223, 217, 213);;">
        <div class="container">
            <h2>Contact Us</h2>

            <div class="flex">
                <div id="form-container">
                    <h3>Contact Form</h3>
                    <form>
                        <label for="name">Name</label>
                        <input type="text" id="name" />

                        <label for="email">Email</label>
                        <input type="text" id="email" />

                        <label for="subject">Subject</label>
                        <input type="text" id="subject" />

                        <label for="message">Message</label>
                        <textarea id="message">Write your message here..</textarea>

                        <button class="rounded">Send Message</button>
                    </form>
                </div>

                <div id="address-container">
                    <label>Address</label>
                    <address>
                        20377 Evergreen Terrace Mountain View, California, USA
                    </address>

                    <label>Phone</label>
                    <a href="#">232-232-2323</a>

                    <label>Email Address</label>
                    <a href="#">ouremail@domain.com</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="flex container">
            <div class="footer-about">
                <h5>About Stated</h5>
                <p>It was Started in 2020.At Prime Property Co., we specialize in connecting people with their perfect homes. Our team of experienced professionals is dedicated to making the process of buying, selling, and renting properties seamless and stress-free.
                </p>
            </div>

            <div class="footer-quick-links">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-subscribe">
                <h5>Subscribe to our Newsletter</h5>
                <div id="subscribe-container">
                    <input type="text" placeholder="Enter Email" />
                    <button class="right-rounded">Send</button>
                </div>

                <h5 class="follow-us">Follow Us</h5>
                <ul>
                    <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                </ul>
            </div>
        </div>    
    </footer>
    <script src="script.js"></script>
<!-- Modal -->
<div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agentModalLabel">Agent Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="agent-img" src="" alt="Agent Image" style="width: 100%; margin-bottom: 15px;">
        <h3 id="agent-name"></h3>
        <p id="agent-role"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 
<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></scr>

<scrip>
  document.querySelectorAll('.btnn').forEach((button) => {
    button.addEventListener('click', function (event) {
      event.preventDefault();

      // Find the closest card element and extract agent details
      const card = this.closest('.card');
      const agentName = card.querySelector('h3').textContent;
      const agentRole = card.querySelector('p').textContent;
      const agentImgSrc = card.querySelector('img').src;

      // Update modal content
      document.getElementById('agent-name').textContent = agentName;
      document.getElementById('agent-role').textContent = agentRole;
      document.getElementById('agent-img').src = agentImgSrc;

      // Show the modal
      const agentModal = new bootstrap.Modal(document.getElementById('agentModal'));
      agentModal.show();
    });
  });
</script>

</body>
</html>