<?php
session_start();
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Now</title>
    <link rel="stylesheet" href="assets/css/support.css"> 
</head>
<body>
    <div class="header">
        <h1>Support Now</h1>
    </div>

    <div class="container">
        <div class="content">
         
            <div class="select-campaign">
                <h2>Select a Campaign</h2>
                <form id="supportForm" action="process_support.php" method="POST" onsubmit="return validateForm()">
                    <label for="campaign">Choose a campaign:</label>
                    <select name="campaign_id" id="campaign" required>
                        <option value="">Loading campaigns...</option>
                    </select>

                  
                    <div class="back-now">
                        <h3>Enter Your Donation Amount</h3>
                        <input type="number" name="amount" id="amount" placeholder="Enter the amount you want to pledge" required>

                       
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

                        <h3>Payment Information</h3>
                        <input type="text" name="cardholder-name" id="cardholder-name" placeholder="Cardholder Name" required>
                        <input type="text" name="card-number" id="card-number" placeholder="Card Number" required>
                        <input type="text" name="expiry-date" id="expiry-date" placeholder="Expiry Date (MM/YY)" required>
                        <input type="text" name="cvv" id="cvv" placeholder="CVV" required>

                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>

            
            <div class="back-button">
                <a href="homepage.php">Back to Homepage</a> 
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("getCampaigns.php")
                .then(response => response.json())
                .then(data => {
                    const campaignDropdown = document.getElementById("campaign");
                    campaignDropdown.innerHTML = "<option value='' disabled selected>Select a campaign</option>";  
                    data.forEach(campaign => {
                        const option = document.createElement("option");
                        option.value = campaign.id;
                        option.textContent = `Campaign: ${campaign.goal} (Title: ${campaign.title})`;
                        campaignDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Error fetching campaigns:", error);
                    const campaignDropdown = document.getElementById("campaign");
                    campaignDropdown.innerHTML = "<option value=''>Failed to load campaigns</option>";
                });
        });

        function validateForm() {
            const campaign = document.getElementById("campaign").value;
            const amount = document.getElementById("amount").value;
            const cardholderName = document.getElementById("cardholder-name").value;
            const cardNumber = document.getElementById("card-number").value;
            const expiryDate = document.getElementById("expiry-date").value;
            const cvv = document.getElementById("cvv").value;

            
            if (!campaign) {
                alert("Please select a campaign.");
                return false;
            }

            
            if (!amount || amount <= 0) {
                alert("Please enter a valid amount.");
                return false;
            }

            
            if (!cardholderName) {
                alert("Please enter the cardholder's name.");
                return false;
            }

            
            if (!cardNumber || cardNumber.length !== 16 || isNaN(cardNumber)) {
                alert("Please enter a valid 16-digit card number.");
                return false;
            }

            
            if (!expiryDate || !/^\d{2}\/\d{2}$/.test(expiryDate)) {
                alert("Please enter a valid expiry date (MM/YY).");
                return false;
            }

            
            if (!cvv || cvv.length !== 3 || isNaN(cvv)) {
                alert("Please enter a valid CVV (3 digits).");
                return false;
            }

            return true; 
        }
    </script>
</body>
</html>
// update support.php