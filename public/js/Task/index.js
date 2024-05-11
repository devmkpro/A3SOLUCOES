document.querySelectorAll('.delete-btn').forEach(button => {
  button.addEventListener('click', () => {
      const taskId = button.dataset.taskId;
      const modal = document.querySelector('#popup-modal');
      const form = modal.querySelector('form');
      form.action = form.action.replace('task_id', taskId);
      form.querySelector('input[name="task_id"]').value = taskId;
  });
});