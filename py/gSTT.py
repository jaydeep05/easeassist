# import speech_recognition as sr 
# import sys

# AUDIO_FILE = "/Applications/XAMPP/htdocs/php/SGH000699/Hackathon_php/ease/uploads/test.wav"
# # AUDIO_FILE = sys.argv[1]
# r = sr.Recognizer()
# with sr.AudioFile(AUDIO_FILE) as source:
#     audio = r.record(source)   
  
# try: 
#     print("The audio file contains: " + r.recognize_google(audio)) 
  
# except sr.UnknownValueError: 
#     print("Google Speech Recognition could not understand audio") 
  
# except sr.RequestError as e: 
#     print("Could not request results from Google Speech Recognition service; {0}".format(e)) 



from google.cloud import speech_v1
from google.cloud.speech_v1 import enums

client = speech_v1.SpeechClient()

encoding = enums.RecognitionConfig.AudioEncoding.FLAC
sample_rate_hertz = 44100
language_code = 'en-US'
config = {'encoding': encoding, 'sample_rate_hertz': sample_rate_hertz, 'language_code': language_code}
uri = 'gs://bucket_name/file_name.flac'
audio = {'uri': uri}

response = client.recognize(config, audio)