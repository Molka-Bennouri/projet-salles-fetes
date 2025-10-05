document.getElementById("localisation").addEventListener("change", function () {
    let loc = document.getElementById("localisation").value; // Correctly get the selected value
    let servicesSupplementaires = document.querySelector(".services-supplementaires");

    // Remove previously added services
    servicesSupplementaires.innerHTML = "";

    // Add services dynamically based on the selected location
    if (loc === "Boumhel") {
        servicesSupplementaires.innerHTML += `
            <label class="dynamic-service">
                <input type="checkbox" name="services[]" value="Bar à cocktails"> Bar à cocktails
            </label><br>`;
    } else if (loc === "La marsa") {
        servicesSupplementaires.innerHTML += `
            <label class="dynamic-service">
                <input type="checkbox" name="services[]" value="Feu d’artifice"> Feu d’artifice
            </label><br>`;
    } else if (loc === 'Morneg') {
        servicesSupplementaires.innerHTML += `
            <label class="dynamic-service">
                <input type="checkbox" name="services[]" value="dîner"> Préparation et service d'un dîner
            </label>
            <label class="dynamic-service">
                <input type="checkbox" name="services[]" value="pâtisseries et salés"> Distribution de pâtisseries et de mets salés en partenariat avec Mme Hachicha et Gourmandise
            </label><br>`
            ;
    }
});

function validateEmail() {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let emailInput = document.getElementById("email");

    if (!regex.test(emailInput.value)) {
        emailInput.style.backgroundColor = 'pink';
        return false;
    } else {
        emailInput.style.backgroundColor = 'white';
        return true;
    }
}

function validateTel() {
    let telInput = document.getElementById("tel");

    if (telInput.value.length !== 8 || isNaN(telInput.value)) {
        telInput.style.backgroundColor = 'pink';
        return false;
    } else {
        telInput.style.backgroundColor = 'white';
        return true;
    }
}
function validateForm() {
    let button = document.querySelector(".button");

    if (validateTel() && validateEmail()) {
        button.innerHTML = `<input type="submit" value="Réserver">`;
    } else {
        button.innerHTML = `<input type="submit" value="Réserver" disabled>`;
    }
}

