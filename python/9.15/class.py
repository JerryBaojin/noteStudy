class Student(object):
	"""docstring for ClassName"""
	def __init__(self, arg,score):
		self.__arg = arg
		self.__score=score
	def get_arg(self):
		return self.__score

bart=Student('bart',135)

print(bart.get_arg())

# def print_score(std):
# 	print('%s:%s' % (std.arg,std.score))

# print_score(bart)