var stack1 = new Stack<int>();
var stack2 = new Stack<int>();
var stack3 = new Stack<int>();

stack1.Push(5);
stack1.Push(4);
stack1.Push(3);
stack1.Push(2);
stack1.Push(1);

stack3.Push(stack1.Pop());  //1   van stack 1 naar 3
stack2.Push(stack1.Pop());  //2   van stack 1 naar 2
stack2.Push(stack3.Pop());  //21  van stack 2 naar 3

stack3.Push(stack1.Pop());  //3   van stack 1 naar 3
stack3.Push(stack2.Pop());  //32  van stack 2 naar 3
stack3.Push(stack2.Pop());  //321 van stack 2 naar 3

stack2.Push(stack1.Pop());  //4   van stack 1 naar 2
stack2.Push(stack3.Pop());  //43  van stack 3 naar 2
stack2.Push(stack3.Pop());  //432     van stack 3 naar 2
stack2.Push(stack3.Pop());  //4321    van stack 3 naar 2

stack3.Push(stack1.Pop());  //5       van stack 1 naar 3
stack3.Push(stack2.Pop());  //54      van stack 2 naar 3
stack3.Push(stack2.Pop());  //543     van stack 2 naar 3
stack3.Push(stack2.Pop());  //5432    van stack 2 naar 3
stack3.Push(stack2.Pop());  //54321   van stack 2 naar 3


Console.WriteLine("Klaar");
