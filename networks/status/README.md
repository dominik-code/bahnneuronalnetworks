# Inputs from user

* User will see cancellation statistic for each train at a specific station
  * So in short we will receive a stationID and a trainID and need to predict on these

# Inputs we use internal (this is subject to change

Ideas:
* The route of the train
* The station we want to predict (as a train can be cancelled while driving)
* the train number
* maybe a statistic based on old datasets like 50% of times the train was cancelled
* based on the date the day of the week (like monday or friday)

# Outputs

We want here 3 states.
* -1 === train cancellation
* 0 === train planned (internal state but not often used)
* 1 === train ok

The actual result will be a float or double within the range [-1,1] so we will need to denormalize the result and map it to the correct state.




# Todolist

* Build database connection for getting training data
* Build load/save script for nn to be saved and loaded from database
* Build normalizer and denormalizer for input values and output values
* Train the nn and see results, based on the results do fine tuning or change inputs.