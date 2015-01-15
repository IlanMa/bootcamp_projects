class PetsController < ApplicationController
  def index
  	#instance variables in Rails controllers automatically are passed to the view
  	@pets = Pet.all
  end

  def new #this method will server a view that allows the user to make a new pet
  	@pet = Pet.new
  end

  def create #this is where the form rendered above will be sent!
  	#similar to php var_dump
  	@pet = Pet.new(pet_params)
  	if @pet.save
  		#if the pet saves correctly, do the good stuff
  		redirect_to "/pets/index"
  	else
  		# if it fails validation, do the bad stuff
  	end
  end
  private	

	  #white list user submitted data
	  def pet_params
	  	params.require(:pet).permit(:name,:breed)
	  	# this returns a hash with all the submitted parameters, with just the stuff we want
	  end
end
