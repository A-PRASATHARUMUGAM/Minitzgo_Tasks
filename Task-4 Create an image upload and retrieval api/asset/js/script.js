
const formField = document.querySelector('.form-container');
const uploadedArea = document.querySelector('.img-upload-field');
const fileInput = document.querySelector('.img-upload-input');
// Timestamp
const timestampDisplay = document.querySelector('.timestampdisplay');



// Uploade Image Click 
function uploadProcess() {

    uploadedArea.addEventListener('click', () => {
        fileInput.click();

    })

}

uploadProcess()



// Timestamp Display process 
function timeStampBtn() {

    formField.addEventListener('submit', (event) => {

        event.preventDefault()


        const formattedDate = new Date();



        timestampDisplay.innerHTML = `<b>Uploaded Time</b>: ${formattedDate}`;


        // alert the submition and rest from 

        setTimeout(() => {
            alert('Image uploade successfully!');
            myForm.reset();
        }, 500);


    })



}

timeStampBtn()

