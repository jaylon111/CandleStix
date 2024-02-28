from flask import Flask, request, render_template
import yfinance as yf
import pandas as pd
from flask_cors import CORS
import plotly.graph_objs as go
from plotly.subplots import make_subplots

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

@app.route('/')
def index():
    return """
    <html>
    <body>
    <h1>CandleStix</h1>
    <form action="/predict" method="post">
        <label for="stock_ticker">Enter Stock Ticker:</label>
        <input type="text" id="stock_ticker" name="stock_ticker" value="TSLA"><br><br>
        <input type="submit" value="Predict">
    </form>
    </body>
    </html>
    """

@app.route('/predict', methods=['POST'])
def predict():
    user_input = request.form['stock_ticker']
    stock = yf.Ticker(user_input)
    data = stock.history(period="100d")
    data.to_csv('yahoo.csv')
    description = data.describe().to_html()

    # Generate line chart
    fig = make_subplots(rows=1, cols=1)
    fig.add_trace(go.Scatter(x=data.index, y=data['Close'], mode='lines', name='Close Price'), row=1, col=1)
    fig.update_layout(title='Stock Closing Prices', xaxis_title='Date', yaxis_title='Price')
    chart_div = fig.to_html(full_html=False)

    return """
    <html>
    <body>
    <h2>Last 100 Days Data Description</h2>
    {}
    {}
    </body>
    </html>
    """.format(description, chart_div)

if __name__ == '__main__':
    app.run(debug=True)
