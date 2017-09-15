class Student(object):
	"""docstring for ClassName"""
	def __init__(self, arg,score):
		self.arg = arg
		self.score=score
bart=Student('bart',135)

def print_score(std):
	print('%s:%s' % (std.arg,std.score))

print_score(bart)