require('dotenv').config();
const mongoose = require('mongoose');

mongoose.set('strictQuery', false);
mongoose.connect(process.env.MONGODB_URL)
.then(() => {
    console.log('db connect');
}).catch((err) => {
    console.log('no db');
});

module.exports = mongoose;