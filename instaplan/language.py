import re
import string

EVENTS   = ['Breakfast','Morning','Lunch','Afternoon','Dinner','Desert','Evening','Overnight']
NEGATION = ['not ','no ','without ','in','un','non','high ', '0 ']
PRIORITY = ['really ','very ','extremely ','lot ','lots ','many ','extraordinarily ','low ','highly ']
plan = {}

SINGLE_DIGITS = {'zero':0,'one':1,'two':2,'three':3,'four':4,'five':5,'six':6,'seven':7,'eight':8,'nine':9,'ten':10,'eleven':11,'twelve':12,'thirteen':13,'fourteen':14,'fifteen':15,'sixteen':16,'seventeen':17,'eighteen':18,'nineteen':19}
TENS = {'twenty':2,'thirty':3,'fourty':4,'fifty':5,'sixty':6,'seventy':7,'eighty':8,'ninety':9}

def get_keywords(query):
	query = reformat(query)
	words = query.split(' ')
       	b_hi = regex_check(['expensive','fancy','extravagent'],query)
	b_lo = regex_check(['cheap','budget'],query)
	plan['budget'] = (b_hi - b_lo + 3) / 1.5
	
	k = regex_check(['kid','child','son','daughter'],query)
	if k == -1 or k == 0:
		plan['kids'] = False
	else:
		plan['kids'] = True
	location = re.search('(in|near|go to) (\w+)',query)
	if location:
		plan['location'] = location.group(2).title()
	else:
		plan['location'] = ''
	days = re.search('([0-9]+) day',query)
	if days and days.group(1) != '0':
		plan['days'] = int(days.group(1))
		plan['events'] = make_events(int(days.group(1)))
	else:
		plan['events'] = [word.title() for word in query.split(' ') if word.title() in EVENTS]
		plan['days'] = 0
	return plan

def regex_check(word,query):
	checker = re.search('(\w+ ?)(%(word)s)' % {'word':'|'.join(word)},query)
	if checker is not None:
		if checker.group(1) in NEGATION:
			return -1
		elif checker.group(1) in PRIORITY:
			return 2
		else:
			return 1
	else:
		return 0

def reformat(s):
	s = s.lower()
	s = re.sub('[^\w ]+', '', s)
	single_dig = '|'.join(SINGLE_DIGITS)
	reg = re.findall('(\w+)(.?)('+single_dig+') ',s)
	if reg is not None:
		for r in reg:
			if r[0] in TENS:
				num = ''
				num += str(TENS[r[0]])
				num += str(SINGLE_DIGITS[r[2]])
				s = s.replace(r[1].join([r[0],r[2]]),num)
			else:
				num = str(SINGLE_DIGITS[r[2]])
				s = s.replace(r[2],num)
	reg = re.findall('|'.join(TENS),s)
	if reg is not None:
		for r in reg:
			s = s.replace(r,str(TENS[r])+'0')
	return s

def make_events(days):
    if days > 0:
        events = ["Day "+str(i+1)+": "+e for i in range(days) for e in EVENTS]
        events.pop(len(events) - 1)
        return events
    else:
        return []


def create_sidebar(keywords):
    print '<div id="adjust"><h3>Fine Tuner</h3>',
    print '<form action="result.php" method="get">',
    print '<input type="hidden" name="type" value="adjust">',
    print '<h5>Location</h5>',
    print '<input type="text" name="location" value="'+keywords['location']+'" />',
    print '<h5>Budget</h5>',
    print '<input type="hidden" name="type" value="update" />',
    print '$ <input class="slide" name="budget" type="range" min="0" max="4" step="0.2" value="'+str(keywords['budget'])+'" width="100px"> $$$$',
    print '<h5>Duration</h5>',
    print '<input name="days" type="number" min="0" max="20" value="'+str(keywords['days'])+'" /> Days',
    print '<h5>Options</h5>',
    print '<input type="checkbox" name="option" value="kids" />Kids',
    print '<input type="checkbox" name="option" value="family" /> Family<br /><br />',
    print '<input type="submit" />',
    print '</form>',
    print '<h3>Get Directions</h3><form>',
    print '<select name="transport">',
    print '<option>Public Transport</option>',
    print '<option>Car</option>',
    print '<option>Walking</option>',
    print '<option>Fixie</option>',
    print '</select><br />',
    print '<input type="submit" />',
    print '</form>',
    print '</div>',
    print '<div id="content">',
    print '<div id="map-canvas"><</div>',
    print '<h1>My Plan</h1>',
