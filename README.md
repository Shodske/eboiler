# E-boiler
A very basic example app where one can switch boilers on and off based on the energy price.

A boiler can be switched from price based (auto) to manually deciding if it should be turned on or off.
Click auto/manual to switch between the modes.

When the boiler is on auto, you cannot change the on/off status. 

Because there was a time limit of 4 hours for this excercise a lot of shortcuts have been made to get this app from zero
to here.

## Setup
This project uses Laravel + Vuejs in Docker. Make sure you have docker installed for an easy setup. By default the app
runs on http://localhost:80/ so make sure that port is available on your local machine.

Run the following command to set up the project. 
```bash
make setup
```

To start the project run.
```bash
make start
```

To stop the project run:
```bash
make stop
```
