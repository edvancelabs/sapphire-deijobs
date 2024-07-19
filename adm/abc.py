import time 
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options

def download_webpage(url, output_file):
    try:
        # Set up Chrome options
        #options = Options()
        #options.headless = True  # Run Chrome in headless mode (no GUI)
        options = webdriver.ChromeOptions()
        options.add_argument('--headless')
        options.add_argument('--disable-dev-shm-usage')
        options.add_argument('--user-data-dir=/tmp/chrome-profile')



        # Set up Chrome service
        service = Service('/usr/bin/chromedriver')  # Replace with the path to chromedriver executable
        service.start()

        # Create a new instance of the Chrome driver
        driver = webdriver.Chrome(service=service, options=options)
        driver.implicitly_wait(5)
        # Navigate to the URL
        driver.get(url)
        time.sleep(20)

        # Get the page source
        page_source = driver.page_source

        # Write the page source to a file
        with open(output_file, 'w', encoding='utf-8') as f:
            f.write(page_source)

        print(f"Webpage downloaded successfully to {output_file}")
    except Exception as e:
        print(f"An error occurred: {e}")
    finally:
        # Quit the driver
        driver.quit()
        # Stop the Chrome service
        service.stop()

# Example usage:
url = 'https://deijobs.in'
output_file = '../react-app/webpage.html'
download_webpage(url, output_file)

