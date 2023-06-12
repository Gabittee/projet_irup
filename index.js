require('dotenv').config();
require('./config/mongodb');
const express = require('express');
const bodyParser = require('body-parser');

const app = express();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

const eleveRoute = require('./routes/eleve');
const pointageRoute = require('./routes/pointage');
const badgeRoute = require('./routes/badge-check');

app.use('/eleve', eleveRoute);
app.use('/pointage', pointageRoute);
app.use('/badge', badgeRoute);

app.listen(process.env.PORT, () => {
    console.log('connect');
})
