class StuffsController < ApplicationController
  def index
  	@quote = Stuff.new
  end

  def new
  	@quote = Stuff.new(quote_params)
  	if @quote.save
  		redirect_to '/stuffs/result'
  	end
  end

  def result
  	@quotes = Stuff.all
  end

  private

  def quote_params
  	params.require(:stuff).permit(:name,:stuff)
  end
end
