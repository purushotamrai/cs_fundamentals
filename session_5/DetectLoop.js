class Node {
    constructor(element) {
        this.element = element;
        this.next = null;
    }
}

class LinkedList {
    constructor() {
        this.head = null;
        this.tail = null;
        this.size = 0;
    }

    // prepend
    prepend(element) {
        var node = new Node(element);
        if (this.size == 0) {
            // create node
            this.head = node;
            this.tail = node;
        }
        else {
            var current = this.head;
            node.next = current;

            this.head = node;
        }
        this.size++;
    }

    // append
    append(element) {
        var node = new Node(element);
        if (this.size == 0) {
            // create node
            this.head = node;
            this.tail = node;
        }
        else {
            var last = this.tail;
            last.next = node;

            this.tail = node;
        }
        this.size++;
    }

    // insert
    insert(element, index) {
        if (index < 0 && index > this.size) {
            return false;
        }
        else {
            if (index == 0) {
                this.prepend(element);
            }
            else if (index == this.size) {
                this.append(element);
            }
            else if (index > 0 && index < this.size) {
                var current = this.head;
                for (var i = 0; i < (index - 1) ; i++) {
                    current = current.next;
                }

                var node = new Node(element);
                node.next = current.next;

                current.next = node;
                this.size++;
            }
        }
    }

    // delete
    delete(index) {
        if (index < 0 && index > (size - 1)) {
            return false;
        }
        else {
            if (index == 0) {
                var current = this.head;
                this.head = current.next;
                current.next = null;
                this.size--;
            }
            else {
                var current = this.head;

                for (var i = 0; i < (index - 1); i++) {
                    current = current.next;
                }
                
                var toBeDeleted = current.next;
                console.log(toBeDeleted);
                
                current.next = toBeDeleted.next;
                toBeDeleted.next = null;
                this.size--;

                if (index == this.size) {
                    this.tail = current;
                }
            }
        }
    }

    // lookup
    lookup(index) {
        if (index < 0 && index >= this.size) {
            return false;
        }
        else {
            if (index == 0) {
                return this.head;
            }
            else if (index == this.size - 1) {
                return this.tail;
            }
            else {
                var count = 0;
                var current = this.head; 
                for (var i =0; i < this.size; i++) {
                    if (i == index) {
                        return current;
                    }
                    current = current.next;
                }
            }
        }
    }

    // print
    print() {
        var current = this.head;
        if (this.size > 0) {
            // var linkedListPrint = '';
            var count = 0
            while(current.next && count <= this.size) {
                console.log(current);
                current = current.next;
                count++;
            }
        }
        else {
            console.log('Empty Linked List');
        }
       
    }

    detectLoop() {
        var current = this.head;
        if (this.size > 0) {
            var count = 0;
            while (current.next) {
                current = current.next;
                count++;

                if (count > this.size) {
                    console.log('loop detected');
                    return true;
                }
            }

        }
        else {
            console.log('LinkedList Empty');
        }
    }
}

var TestLinkedList = new LinkedList();

TestLinkedList.prepend({'A' : 'Apple'});
TestLinkedList.insert({'B' : 'Ball'}, 1);
TestLinkedList.append({'C' : 'Cat'});
TestLinkedList.append({'D' : 'Dog'});

// TestLinkedList.print();

// Create a loop -> a,b,c,d,b
TestLinkedList.tail.next = TestLinkedList.head.next;

TestLinkedList.print();

TestLinkedList.detectLoop();