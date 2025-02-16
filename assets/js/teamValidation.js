const team_name = document.querySelector('#name');
const team_city = document.querySelector('#city');
const team_sport = document.querySelector('#sport');
const team_year_of_foundation = document.querySelector('#yearOfFoundation');
const save_button = document.querySelector('.save-button');
const team_form = document.querySelector('.base-form');
const field_validation = document.querySelectorAll('.field-validation');

team_form.addEventListener('submit', function(e){
    e.preventDefault();
    let allow_submit = true;
    let failedFields = [];
    field_validation.forEach(element => {
        element.classList.add('hidden');
    });

    if(team_name.value.length === 0){
        allow_submit = false;
        failedFields.push('name');
    }

    if(team_city.value.length === 0){
        allow_submit = false;
        failedFields.push('city');
    }

    if(team_year_of_foundation.value.length === 0){
        allow_submit = false;
        failedFields.push('year_of_foundation');
    }

    if(team_sport.value.length === 0){
        allow_submit = false;
        failedFields.push('sport');
    }

    if(!allow_submit){
        console.log(failedFields);
        failedFields.forEach(element => {
            document.querySelector('.'+element+'-validation').classList.remove('hidden');
        });
        return;
    }

    team_form.submit();
});
