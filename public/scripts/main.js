console.log("Running index");

// const delButtons = document.querySelectorAll(".del-Btn");

// delButtons.forEach(el =>
//     el.addEventListener("click", event => {
//         event.preventDefault(); //turned off standart submit
//         console.log("Clicked me!", event.target.id);
//         event.target.parentElement.parentElement.classList.add("fading");
//         setTimeout(
//             el => {
//                 el.style.backgroundColor = "green";
//                 // alert("Hello");

//                 el.parentElement.submit();
//             },
//             3000, //time in ms
//             event.target //I pass argument to the callback function so el==event.target whent it is called
//         );
//     })
// );

// console.log("Listeners added!");