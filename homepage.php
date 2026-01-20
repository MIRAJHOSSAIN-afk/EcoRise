<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRise</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="assets/css/homepage.css"> 
</head>
<body>
    <div class="header-hero-section">
        <div class="header">
            <h1>EcoRise</h1>
            <div class="header-buttons">
                <a href="champ.php">Campaigns</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Sign Out</a>
            </div>
        </div>

        <div class="hero-content">
            <h1>EcoRise: Supporting Sustainable Innovations for a Better Planet</h1>
            <p>Join us in funding a sustainable future and making a lasting impact on the planet</p>
            <button class="w3-button w3-black w3-large">
                <a href="support.php" style="color: white;">Support Now</a>
            </button>
        </div>
    </div>

    <div class="w3-container w3-padding-64">
        <h2 class="w3-center"><a href="champ.php">Popular Campaigns</a></h2>
        <div class="campaign-grid">
            <p>Loading campaigns...</p> 
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

   
    <div class="footer">

    <div class="footer-section left-footer">
        <h2>About Us</h2>
        <p>EcoRise is a crowdfunding platform dedicated to supporting environmental initiatives and promoting a sustainable future. Our mission is to empower individuals, communities, and organizations to create and fund impactful eco-projects that make a difference in the world.</p>
    </div>

    <div class="footer-section right-footer">
        <h2>Contact Us</h2>
        <p>Email: support@ecorise.com</p>
        <p>Phone: 01813609364</p>
    </div>
</div>
</body>
</html>
// homepage has been completed 