const player_name = document.querySelector('#name');
const player_surname = document.querySelector('#surname');
const player_number = document.querySelector('#number');
const player_birth = document.querySelector('#birth');
const save_button = document.querySelector('.save-button');
const player_form = document.querySelector('.base-form');
const field_validation = document.querySelectorAll('.field-validation');


player_form.addEventListener('submit', function(e){
    e.preventDefault();
    let allow_submit = true;
    let failedFields = [];
    field_validation.forEach(element => {
        element.classList.add('hidden');
    });

    if(player_name.value.length === 0){
        allow_submit = false;
        failedFields.push('name');
    }

    if(player_surname.value.length === 0){
        allow_submit = false;
        failedFields.push('city');
    }

    if(player_number.value.length === 0){
        allow_submit = false;
        failedFields.push('year_of_foundation');
    }

    if(player_birth.value.length === 0){
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

    player_form.submit();
});