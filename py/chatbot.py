import numpy as np
import gensim
print(f"Gensim version: {gensim.__version__}")

from tqdm import tqdm
class TqdmUpTo(tqdm):
    def update_to(self, b=1, bsize=1, tsize=None):
        if tsize is not None: self.total = tsize
        self.update(b * bsize - self.n)

def get_data(url, filename):
    """
    Download data if the filename does not exist already
    Uses Tqdm to show download progress
    """
    import os
    from urllib.request import urlretrieve
    
    if not os.path.exists(filename):

        dirname = os.path.dirname(filename)
        if not os.path.exists(dirname):
            os.makedirs(dirname)

        with TqdmUpTo(unit='B', unit_scale=True, miniters=1, desc=url.split('/')[-1]) as t:
            urlretrieve(url, filename, reporthook=t.update_to)
    else:
        print("File already exists, please remove if you wish to download again")

embedding_url = 'http://nlp.stanford.edu/data/glove.6B.zip'
get_data(embedding_url, 'data/glove.6B.zip')

from gensim.scripts.glove2word2vec import glove2word2vec
glove_input_file = 'data/glove.6B.300d.txt'
word2vec_output_file = 'data/glove.6B.300d.txt.word2vec'
import os
if not os.path.exists(word2vec_output_file):
    glove2word2vec(glove_input_file, word2vec_output_file)


# %%time
from gensim.models import KeyedVectors
filename = word2vec_output_file
embed = KeyedVectors.load_word2vec_format(word2vec_output_file, binary=False)


assert embed['awesome'] is not None


cuisine_refs = ["mexican", "thai", "british", "american", "italian"]
sample_sentence = "I’m looking for a cheap Indian or Chinese place in Indiranagar"


tokens = sample_sentence.split()
tokens = [x.lower().strip() for x in tokens] 
# threshold = 18.3
# found = []
# for term in tokens:
#     if term in embed.vocab:
#         scores = []
#         for C in cuisine_refs:
#             scores.append(np.dot(embed[C], embed[term].T))
#             # hint replace above above np.dot with: 
#             # scores.append(embed.cosine_similarities(<vector1>, <vector_all_others>))
#         mean_score = np.mean(scores)
#         print(f"{term}: {mean_score}")
#         if mean_score > threshold:
#             found.append(term)
# print(found)



def sum_vecs(embed,text):

    tokens = text.split(' ')
    vec = np.zeros(embed.vector_size)

    for idx, term in enumerate(tokens):
        if term in embed.vocab:
            vec = vec + embed[term]
    return vec

# sentence_vector = sum_vecs(embed, sample_sentence)
# print(sentence_vector.shape)


data={
  "greet": {
    "examples" : ["hello","hey there","howdy","hello","hi","hey","hey ho"],
    "centroid" : None
  },
  "inform": {
    "examples" : [
        "i'd like something asian",
        "maybe korean",
        "what mexican options do i have",
        "what italian options do i have",
        "i want korean food",
        "i want german food",
        "i want vegetarian food",
        "i would like chinese food",
        "i would like indian food",
        "what japanese options do i have",
        "korean please",
        "what about indian",
        "i want some chicken",
        "maybe thai",
        "i'd like something vegetarian",
        "show me french restaurants",
        "show me a cool malaysian spot",
        "where can I get some spicy food"
    ],
    "centroid" : None
  },
  "deny": {
    "examples" : [
      "nah",
      "any other places ?",
      "anything else",
      "no thanks"
      "not that one",
      "i do not like that place",
      "something else please",
      "no please show other options"
    ],
    "centroid" : None
  },
    "affirm":{
        "examples":[
            "yeah",
            "that works",
            "good, thanks",
            "this works",
            "sounds good",
            "thanks, this is perfect",
            "just what I wanted"
        ],
        "centroid": None
    }

}



# def get_centroid(embed, examples):
#     C = np.zeros((len(examples),embed.vector_size))
#     for idx, text in enumerate(examples):
#         C[idx,:] = sum_vecs(embed,text)

#     centroid = np.mean(C,axis=0)
#     assert centroid.shape[0] == embed.vector_size
#     return centroid



# # Adding Centroid to data dictionary
# for label in data.keys():
#     data[label]["centroid"] = get_centroid(embed,data[label]["examples"])



# for label in data.keys():
#     print(f"{label}: {data[label]['examples']}")



def get_intent(embed,data, text):
    intents = list(data.keys())
    vec = sum_vecs(embed,text)
    scores = np.array([ np.linalg.norm(vec-data[label]["centroid"]) for label in intents])
    return intents[np.argmin(scores)]



# for text in ["hey ","i am looking for chinese food","not for me", "ok, this is good"]:
#     print(f"text : '{text}', predicted_label : '{get_intent(embed, data, text)}'")



templates = {
        "utter_greet": ["hey there!", "Hey! How you doin'? "],
        "utter_options": ["ok, let me check some more"],
        "utter_goodbye": ["Great, I'll go now. Bye bye", "bye bye", "Goodbye!"],
        "utter_default": ["Sorry, I didn't quite follow"],
        "utter_confirm": ["Got it", "Gotcha", "Your order is confirmed now"]
    }


response_map = {
    "greet": "utter_greet",
    "affirm": "utter_goodbye",
    "deny": "utter_options",
    "inform": "utter_confirm",
    "default": "utter_default",
}

import random
def get_bot_response(bot_response_map, bot_templates, intent):
    if intent not in list(response_map):
        intent = "default"
    select_template = bot_response_map[intent]
    templates = bot_templates[select_template]
    return random.choice(templates)



# user_intent = get_intent(embed, data, "i want indian food")
# get_bot_response(response_map, templates, user_intent)




# for text in ["hey","i am looking for italian food","not for me", "ok, this is good"]:
#     user_intent = get_intent(embed, data, text)
#     bot_reply = get_bot_response(response_map, templates, user_intent)
#     print(f"text : '{text}', intent: {user_intent}, bot: {bot_reply}")