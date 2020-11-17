// ######### Does not work on e.target.database.id ##########
// ######### Do not know why atm! ##########

// let editbtn = document.querySelector("#btnedit");

// editbtn.addEventListener("click", (e) => displayData());

// ##########################################################



$(".btnedit").click(e => {
    let textvalues = displayData(e);
    // uncommend for to understand
    // console.log(textvalues)

    let mealId = $("input[name*='food_id']");
    let mealImg = $("input[name*='food_picture']");
    let mealName = $("input[name*='food_name']");
    let mealIngredients = $("input[name*='food_ingridiant']");
    let mealAllergenes = $("input[name*='food_allergen']");
    let mealPrice = $("input[name*='food_price']");

    // console.log(id);
    // console.log(mealImg);
    // console.log(mealName);
    // console.log(mealIngredients);
    // console.log(mealAllergenes);
    // console.log(mealPrice);
    mealId.val(textvalues[0]);
    mealImg.val(textvalues[1]);
    mealName.val(textvalues[2]);
    mealIngredients.val(textvalues[3]);
    mealAllergenes.val(textvalues[4]);
    mealPrice.val(textvalues[5]);
});


// ######## Got this from the Internet no clue whats going on here #######
function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

for (const value of td) {
    if (value.dataset.id == e.target.dataset.id) {
        console.log(e.target.dataset.id); 
        textvalues[id++] = value.textContent;
        console.log(textvalues);
    }
    }
    return textvalues;
}