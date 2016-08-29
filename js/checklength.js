//Función para el campo de piezas a intervenir
function check_length_9(testform)
{
maxLen = 170; // max number of characters allowed
if (testform.comment1.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.comment1.value = testform.comment1.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_9.value = maxLen - testform.comment1.value.length;
}
}

//Función para el segundo campo de comentarios
function check_length_10(testform)
{
maxLen = 88; // max number of characters allowed
if (testform.comment2.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.comment2.value = testform.comment2.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_10.value = maxLen - testform.comment2.value.length;
}
}

//Función para el tercer campo de comentarios
function check_length_11(testform)
{
maxLen = 300; // max number of characters allowed
if (testform.comment3.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.comment3.value = testform.comment3.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_11.value = maxLen - testform.comment3.value.length;
}
}

//Función para el campo de nombre asesor de servicio
function check_length_12(testform)
{
maxLen = 9; // max number of characters allowed
if (testform.firstname1.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.firstname1.value = testform.firstname1.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_12.value = maxLen - testform.firstname1.value.length;
}
}

//Función para el campo de apellido asesor de servicio
function check_length_13(testform)
{
maxLen = 10; // max number of characters allowed
if (testform.lastname1.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.lastname1.value = testform.lastname1.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_13.value = maxLen - testform.lastname1.value.length;
}
}

//Función para el campo de nombre cliente
function check_length_14(testform)
{
maxLen = 15; // max number of characters allowed
if (testform.firstname.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.firstname.value = testform.firstname.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_14.value = maxLen - testform.firstname.value.length;
}
}

//Función para el campo de apellido cliente
function check_length_15(testform)
{
maxLen = 11; // max number of characters allowed
if (testform.lastname.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "Haz alcanzado el máximo de caracteres permitido";
alert(msg);
// Reached the Maximum length so trim the textarea
	testform.lastname.value = testform.lastname.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of comment2 counter
	testform.text_num_15.value = maxLen - testform.lastname.value.length;
}
}

