<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRise</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    
    <link rel="stylesheet" href="assets/css/index.css"> 
</head>
<body>

<div class="header-hero-section">

    <div class="header">
        <h1>EcoRise</h1>
        <div class="header-buttons">
            <a href="signin.php">Sign In</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>


    <div class="hero-content">
        <h1>EcoRise: Supporting Sustainable Innovations for a Better Planet</h1>
        <p>Join us in funding a sustainable future and making a lasting impact on the planet</p>
        <button class="w3-button w3-black w3-large"><a href="signin.php">Support Now</a></button>
    </div>
</div>


<div class="w3-container w3-padding-64">
    <h2 class="w3-center"><a href="signin.php">Popular Campaigns</a></h2>
    <div class="campaign-grid">
        <p>Loading campaigns...</p> 
    </div>
</div>


<div class="join-section">
    <div>
        <h2>Why Join Us?</h2>
        <p>EcoRise is the perfect platform for those passionate about making a positive environmental impact. Join us to connect with like-minded individuals and organizations committed to creating a sustainable future.</p>
        <p>By joining, you'll be part of a global community, gain access to eco-experts, and have the tools to bring meaningful environmental projects to life.</p>
    </div>
    <div>
        <h2>Why Support Us?</h2>
        <p>By supporting EcoRise, you're investing in projects that promote sustainability, from tree planting to renewable energy and recycling initiatives.</p>
        <p>Help us create a greener, more sustainable world—be part of the change!</p>
    </div>
</div>


<div class="w3-container w3-padding-64">
    <h2 class="w3-center">How To Join EcoRise?</h2>
    <div class="how-to-join">
        <div class="how-step">
            <h3>Step 1: Create an Account</h3>
            <p>Sign up to become a member of EcoRise and gain access to exciting opportunities to fund or create impactful environmental projects.</p>
        </div>
        <div class="how-step">
            <h3>Step 2: Explore Projects</h3>
            <p>Browse through various eco-friendly campaigns, including tree planting, renewable energy, and recycling initiatives.</p>
        </div>
        <div class="how-step">
            <h3>Step 3: Contribute or Launch</h3>
            <p>Whether you're supporting an existing project or launching your own, EcoRise makes it easy to contribute to a greener planet.</p>
        </div>
    </div>
</div>


<div class="footer">

    <div class="footer-section left-footer">
        <h2>About Us</h2>
        <p>EcoRise is a crowdfunding platform dedicated to supporting environmental initiatives and promoting a sustainable future. Our mission is to empower individuals, communities, and organizations to create and fund impactful eco-projects that make a difference in the world.</p>
    </div>

   
    <div class="footer-section right-footer">
        <h2>Contact Us</h2>
        <p>Email: support@ecorise.com</p>
        <p>Phone: 01521558948</p>
    </div>
</div>



<script>
   document.addEventListener("DOMContentLoaded", function () {
   
    fetch("getCampaigns.php")
        .then(response => response.json())
        .then(data => {
            const campaignGrid = document.querySelector(".campaign-grid");
            campaignGrid.innerHTML = ""; 

        
            data.forEach(campaign => {
                const progress = (campaign.raised_amount / campaign.target_amount) * 100;

                const campaignCard = `
                    <div class="campaign-card">
                        <img src="${campaign.image_url}" alt="Campaign Image">
                        <h3>${campaign.goal}</h3>
                        <p>$${campaign.raised_amount} raised of $${campaign.target_amount} goal</p>
                        <div class="progress-bar">
                            <div class="progress-bar-inner" style="width: ${progress}%"></div>
                        </div>
                    </div>
                `;
                campaignGrid.innerHTML += campaignCard;
            });
        })
        .catch(error => {
            console.error("Error fetching campaigns:", error);
            const campaignGrid = document.querySelector(".campaign-grid");
            campaignGrid.innerHTML = "<p>Failed to load campaigns. Please try again later.</p>";
        });
});



</script>


</body>
</html>
