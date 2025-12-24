hours = float(input("Enter the number of hours: "))

working_days = int(hours // 8)

working_weeks = int(working_days // 5)
remaining_days = working_days % 5

remaining_hours = round(hours % 8)

units = (
    f"{working_weeks}w" if working_weeks else None,
    f"{remaining_days}d" if remaining_days else None,
    f"{remaining_hours}h" if remaining_hours else None,
)

print(f"{hours}h -> {' '.join(filter(None, units))} of working time")

# Example usage:
# If the user inputs 26.5, the output will be:
# 26.5h -> 3d 2h of working time
