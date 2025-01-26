import React from 'react';
import { createMemoryHistory } from 'history';
import { render, screen, waitFor } from '@testing-library/react';
import Confirm from './Confirm';
import { createMemoryRouter, MemoryRouter, RouterProvider } from 'react-router';
import api from '../../Api';
import Success from '../Success';
test('confirms without token', async () => {
  const history = createMemoryHistory();
  jest.spyOn(api, 'post');
  render(
    <MemoryRouter initialEntries={['/join/confirm']}>
      <Confirm />
    </MemoryRouter>
  );
  expect(history.location.pathname).toBe('/');
  expect(api.post).not.toHaveBeenCalled();
});
test('confirms successfully', async () => {
  jest.spyOn(api, 'post').mockResolvedValue(
    new Response('', {
      status: 201,
      headers: new Headers(),
    })
  );

  const router = createMemoryRouter(
    [
      {
        path: '/join/confirm',
        element: <Confirm />,
      },
      {
        path: '/join/success',
        element: <Success />,
      },
    ],
    {
      initialEntries: ['/join/confirm?token=01'],
    }
  );

  render(<RouterProvider router={router} />);

  await waitFor(() => {
    expect(api.post).toHaveBeenCalled();
  });

  await waitFor(() => {
    expect(router.state.location.pathname).toBe('/join/success');
  });

  expect(api.post).toHaveBeenCalledWith('/v1/auth/join/confirm', {
    token: '01',
  });
});
test('shows error', async () => {
  jest.spyOn(api, 'post').mockRejectedValue({
    ok: false,
    status: 409,
    headers: new Headers({ 'content-type': 'application/json' }),
    json: () => Promise.resolve({ message: 'Incorrect token.' }),
  });
  render(
    <MemoryRouter initialEntries={['/join/confirm?token=01']}>
      <Confirm />
    </MemoryRouter>
  );
  const alert = await screen.findByTestId('alert-error');
  expect(alert).toHaveTextContent('Incorrect token.');
});
