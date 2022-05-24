<h1>Tasks</h1>
<ul>
    <li>Task 1 ()</li>
    <li>Task 2 ()</li>
    <li>Task 3 ()</li>
</ul>
<hr>
<h2>Add a task</h2>
<form action="/task/add" method="post">
    <textarea name="task"></textarea>
    
    <p>Please select the task frecvency:</p>
    <input type="radio" id="weekly" name="frecvency" value="weekly">
    <label for="html">Weekly</label><br>
    <input type="radio" id="Monthly" name="frecvency" value="monthly">
    <label for="Monthly">Monthly</label><br>
    <input type="radio" id="Yearly" name="frecvency" value="yearly">
    <label for="Yearly">Yearly</label>
    <br>
    <input type="date" name="taskDate">
    <br><br>
    <button type="submit">Add</button>
</form>