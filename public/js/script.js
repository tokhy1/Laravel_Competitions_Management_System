// handle contact us
let contactForm = document.getElementById('contact-form');
contactForm.onsubmit = (e) => {
    e.preventDefault()
    window.location.href = "/";
}

function handleClick(section, isIndividual = false) {
    switch (section) {
        case 'users':
            window.location.href = "/dashboard/users"
            break;
        case 'admins':
            window.location.href = "/dashboard/admins"
            break;
        case 'competitions':
            window.location.href = "/dashboard/competitions"
            break;
        case 'events':
            window.location.href = "/dashboard/events"
            break;
        case 'teams':
            window.location.href = "/dashboard/teams"
            break;
        case 'individuals':
            window.location.href = "/dashboard/individuals"
            break;
        case 'events-score':
            if (isIndividual) {
                window.location.href = "/dashboard/individuals-events-score"
                break;
            } else {
                window.location.href = "/dashboard/teams-events-score"
                break;
            }
        case 'competitions-score':
            if (isIndividual) {
                window.location.href = "/dashboard/individuals-competitions-score"
                break;
            } else {
                window.location.href = "/dashboard/teams-competitions-score"
                break;
            }
        default:
            break;
    }
}
